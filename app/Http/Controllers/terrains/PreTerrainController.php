<?php

namespace App\Http\Controllers\Terrains;

use App\Models\Access\User\User;
use App\Models\Terrain;
use App\Models\TerrainCoord;
use Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Terrains\ControlsTerrainController;
use Illuminate\Support\Facades\Auth;


class PreTerrainController extends ControlsTerrainController
{

	public function __construct(){
		parent::__construct();
	}

	public function all(){
		$data = Terrain::with('characteristics','owner')->orderBy('id','DESC')->get()->toArray();
		$out = [];
		foreach($data as $k => $in){
			$in['locatie_string'] = Terrain::locatie()[$in['id_locatie']];
			$out[]=  $in;
		}
		return Response::json(['data' => $out]);
	}

	public function getAprovedTerrains(){
	$data = Terrain::where('aprobat',1);
	return Response::json(['data' => $data]);

	}

	public function getPendingTerrains(){
		$data = Terrain::where('aprobat',null);
		return Response::json(['data' => $data]);

	}

	public function getUserTerrains(){
		$data = Terrain::where('user_id',Auth::user()->id)->with('characteristics')->get();
		return Response::json(['data' => $data]);
	}

	public function save(){
		//De facut verificare cu db daca aprobarea era null si s-a modificat sa se trimita mail cu confirmare
		$data = Input::get('data');
		$data['color_text'] = User::color();
		$out  = Terrain::create($data+['user_id'=>Auth::user()->id]);
		$out->characteristics()->attach($data['id_tip_caracteristici']);

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

}