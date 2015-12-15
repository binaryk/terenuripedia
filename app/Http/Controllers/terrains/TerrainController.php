<?php

namespace App\Http\Controllers\Terrains;

use App\Models\Terrain;
use App\Models\TerrainCoord;
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
        $terrain    = Terrain::all();
        $controls   = $this->controls();
        return view('terrains.index',compact('terrain', 'controls'));
    }

    public function create()
    {
        return view('terrains.create');
    }
}
