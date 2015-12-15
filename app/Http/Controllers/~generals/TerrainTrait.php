<?php

namespace App\Http\Controllers;

use App\Models\Terrain;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

/**
 * Class Controller
 * @package App\Http\Controllers
 */
trait TerrainTrait
{
    public function all()
    {
        return Terrain::all();
    }
}
