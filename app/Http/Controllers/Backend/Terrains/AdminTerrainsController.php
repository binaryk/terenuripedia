<?php namespace App\Http\Controllers\Backend\Terrains;

use App\Http\Controllers\Controller;
use App\Models\Terrain;
use Illuminate\Support\Facades\Input;
use Mockery\CountValidator\Exception;

/**
 * Class DashboardController
 * @package App\Http\Controllers\Backend
 */
class AdminTerrainsController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $terrains = Terrain::orderBy('aprobat','DESC')->get();
        return view('backend.terrains.index')->with(compact('terrains'));
    }

    public function aprobare()
    {
        $id = Input::get('id');
        if(! $terrain = Terrain::find($id) ){
            throw new Exception('Nu gasim terenul cu id: '.$id);
        }

        $terrain->aprobat = !$terrain->aprobat;
        $terrain->save();
        return $terrain;

    }
}
