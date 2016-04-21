<?php

namespace App\Http\Controllers\Terrains;

use App\Models\Access\User\User;
use App\Models\Localitate;
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
		$data = Terrain::with('characteristics','owner')->where('aprobat',1)->orderBy('id','DESC')->get()->toArray();
		$out = [];
		foreach($data as $k => $in){
			$in['locatie_string'] = Localitate::find($in['id_locatie']) ?  Localitate::find($in['id_locatie'])->localitate : '';
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

	public function getUserTerrains($id = null){
        $filter = $id ? $id : Auth::user()->id;
		$data = Terrain::where('user_id',$filter)->with('characteristics','photos','localitate')->get();
		return Response::json(['data' => $data]);
	}



}