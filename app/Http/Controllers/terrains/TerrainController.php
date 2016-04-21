<?php namespace App\Http\Controllers\Terrains;

use App\Models\Access\User\User;
use App\Models\Localitate;
use App\Models\Photo;
use App\Models\Terrain;
use App\Models\TerrainCoord;
use App\Models\UnlokedTerrain;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;

class TerrainController extends PreTerrainController
{
    /**
     * TerrainController constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function index($user = null)
    {  
        $terrain    = Terrain::with('characteristics')->get();
        $controls   = $this->controls();
        return view('terrains.index',compact('terrain', 'controls', 'user'));
    }

    public function create()
    {
        return view('terrains.create');
    }

    public function save(){
        //De facut verificare cu db daca aprobarea era null si s-a modificat sa se trimita mail cu confirmare
        if(auth()->user()->hasRole('Buyer')){
            if( (int) auth()->user()->credit <= config('credit.pret_vanzator')) {
                return redirect()->back()->withFlashError('Nu mai aveti credit');
            }
        }

        $data = Input::get('data');
        $data['color_text'] = User::color();
        $validator = Validator::make(
            $data,
            Terrain::generalValidatorRules(),
            Terrain::generalValidatorMessages()
        );
        if( $validator->passes() )
        {
            try
            {
                $user_ud = (int)$data['user_owner'] > 0 ? $data['user_owner'] : Auth::user()->id;
                unset($data['user_owner']);

                $out  = Terrain::create($data+['user_id'=>$user_ud]);
                if(! auth()->user()->hasRole('Administrator')){
                    User::credit(-config('credit.pret_vanzator'));
                }
                if($data['id_tip_caracteristici']){
                    $out->characteristics()->attach($data['id_tip_caracteristici']);
                }
                $out = Terrain::with('characteristics')->where('id',$out->id)->first();
                $result = ['success' => true, 'message' => 'Datele au fost salvate cu succes!','out' => $out, 'has_abonament' => User::hasAbonament()];
            }
            catch(Exception $e)
            {
                $result = ['success' => false, 'runtime' => 1, 'exception' => ['message' => $e->getMessage(), 'method' => __METHOD__, 'line' => $e->getLine(), 'file' => $e->getFile()]];
            }
            $result['credit'] = auth()->user()->credit;
            return $result;
        }
        $alert = [
            'caption' => 'Atentie',
            'message' => 'Vă rugăm să completați câmpurile obligatorii.',
            'type'    => 'warning'
        ];
        return ['success' => false, 'runtime' => 0, 'messages' => $validator->messages(), 'alert' => $alert];
    }

    public function edit()
    {
        $id   = Input::get('id');
        $data = Input::get('data');
        $data['color_text'] = User::color();
        $validator = Validator::make(
            $data,
            Terrain::generalValidatorRules(),
            Terrain::generalValidatorMessages()
        );
        if( $validator->passes() )
        {
            try
            {
                $out = Terrain::with('characteristics')->where('id',$id)->first();
                $out->update($data);
                $out->characteristics()->detach();
                $out->characteristics()->attach(@$data['id_tip_caracteristici']);
                $out = Terrain::with('characteristics')->where('id',$id)->first();
                $alert = [
                    'caption' => 'Succes',
                    'message' => 'Datele au fost actualizate cu succes.',
                    'type'    => 'success'
                ];
                $result = ['success' => true, 'node' => $out, 'alert' => $alert];
            }
            catch(Exception $e)
            {
                $result = ['success' => false, 'runtime' => 1, 'exception' => ['message' => $e->getMessage(), 'method' => __METHOD__, 'line' => $e->getLine(), 'file' => $e->getFile()]];
            }
            return $result;
        }
        $alert = [
            'caption' => 'Atentie',
            'message' => 'Vă rugăm să completați câmpurile obligatorii.',
            'type'    => 'warning'
        ];
        return ['success' => false, 'runtime' => 0, 'messages' => $validator->messages(), 'alert' => $alert];
    }

    public function delete()
    {
        $id   = Input::get('id');
        $this->model = Terrain::find($id);
        $this->model->delete();
        return Response::json(['success' => true]);
    }

    public function photo()
    {
        $input = Input::all();
        $id =   $input['terrain_id'];
        $file    = $input['file_data'];
        $path = 'photos/terrains/'.$id;
        $res = $file->move(public_path($path), $file->getClientOriginalName());
        $data = [];
        $data['terrain_id'] = $id;
        $data['author']     = access()->user()->id;
        $data['path']       = $res->getPathName();
        $data['extention']  = $res->getExtension();
        $data['storage']    = $res->getSize();
        $data['location']   = asset($path . '/' .$res->getFileName());
        $photo = Photo::create($data);
        return success(['photo' => $photo]);
    }

    public function photoDelete()
    {
        $photo = Input::get('data');
        File::delete($photo['location']);
        Photo::where('id', $photo['id'])->delete();
        return success([], 'Stergerea a avut loc cu success.');
    }

    public function locality($txt = null)
    {
        $txt = Input::get('txt')['term'];
        $out = [];
        foreach(Localitate::where('localitate','like',$txt."%")->get() as $localitate){
            $tmp = [];
            $tmp['id'] = $localitate->id;
            $tmp['text'] = $localitate->localitate;
            $out[] = $tmp;
        }
        return json_encode( $out );

    }

    public function info()
    {
        $id = Input::get('id');
        $user = auth()->user();
        $terr = Terrain::find($id);
        $terr->opened = $terr->openedForCurrentUser($id) > 0;
        return view('static-pages.terrain.info')->with(['terrain' => $terr]);
    }

    public function open()
    {
        $id = Input::get('id');
        if($id == false){
            // return doar credit (pt reresh)
            return success(['credit' => auth()->user()->credit],'Credit actualizat. Incercati sa deschideti contactul proprietarului din nou. Aveti:'.auth()->user()->credit.' RON.');
        }
        if(auth()->user()->credit <= config('credit.pret_cumparator')){
            return error('Nu aveti suficient credit', ['credit' =>  auth()->user()->credit]);
        }else{
            User::credit(-config('credit.pret_cumparator'));
            UnlokedTerrain::create([
                'user_id' => auth()->user()->id,
                'terrain_id' => $id
            ]);
            return success(['success' => 'Am deschis', 'credit' => auth()->user()->credit, 'telefon' => Terrain::find($id)->telefon]);
        }


    }
}
