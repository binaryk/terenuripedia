<?php

namespace App\Http\Controllers\Terrains;

use App\Models\Terrain;
use App\Models\TerrainCoord;
use Illuminate\Support\Facades\Config;
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

    public function photo()
    {
        $input   = Input::all();
        return \Database\Actions::make()->model('\App\Models\Terrain')->data(['terrain_id' => $input['terrain_id']])
            ->upload($input['file_data'], Config::get('uploads.terrain'));
    }
}
