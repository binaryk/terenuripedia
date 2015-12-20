<?php

namespace App\Http\Controllers\Buyer;

use App\Models\Terrain;
use App\Models\TerrainCoord;
use Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class BuyerController extends Controller
{
    public function __construct()
    {
        parent::__construct();

    }

    public function index()
    {
        $terrain    = Terrain::all();
        return view('buyer.index');
    }

}