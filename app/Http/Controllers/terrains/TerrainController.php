<?php

namespace App\Http\Controllers\Terrains;

use App\Models\Terrain;
use App\Models\TerrainCoord;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Response;
use Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

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
        $out  = Terrain::insertRecord($data+['user_id'=>Auth::user()->id]);
        if($data['id_tip_caracteristici']){
            $out->characteristics()->attach($data['id_tip_caracteristici']);
        }
        return Response::json(['out' => $out]);
    }

    public function edit()
    {
        $id   = Input::get('id');
        $data = Input::get('data');
        $this->model = Terrain::with('characteristics')->where('id',$id)->first();
        $this->model->update($data);
        $this->model->characteristics()->detach();
        $this->model->characteristics()->attach(@$data['id_tip_caracteristici']);
        return Response::json(['success' => true, 'node' => $this->model]);
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
