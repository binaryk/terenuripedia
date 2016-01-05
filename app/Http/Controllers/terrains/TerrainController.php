<?php namespace App\Http\Controllers\Terrains;

use App\Models\Access\User\User;
use App\Models\Terrain;
use App\Models\TerrainCoord;
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

    public function index()
    {  
        $terrain    = Terrain::with('characteristics')->get();
        $controls   = $this->controls();
        return view('terrains.index',compact('terrain', 'controls'));
    }

    public function create()
    {
        return view('terrains.create');
    }

    public function save(){
        //De facut verificare cu db daca aprobarea era null si s-a modificat sa se trimita mail cu confirmare
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
                $out  = Terrain::create($data+['user_id'=>Auth::user()->id]);
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
        $input   = Input::all();
        return \Database\Actions::make()->model('\App\Models\Terrain')->data(['terrain_id' => $input['terrain_id']])
            ->upload($input['file_data'], Config::get('uploads.terrain'));
    }
}
