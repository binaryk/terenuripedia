<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Terrain;

/**
 * Class FrontendController
 * @package App\Http\Controllers
 */
class FrontendController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        javascript()->put([
            'test' => 'it works!',
        ]);

        return view('frontend.index')
            ->withMaxExpense(Terrain::bigestPrice())
            ->withMaxAria(Terrain::biggestArea());
    }

    /**
     * @return \Illuminate\View\View
     */
    public function macros()
    {
        return view('frontend.macros');
    }

    public function saller()
    {
        dd('saller');
    }

    public function buyer()
    {
        dd('buyer');
    }

}
