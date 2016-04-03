<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

/**
 * Class DashboardController
 * @package App\Http\Controllers\Frontend
 */
class DashboardController extends Controller
{
    /**
     * @return mixed
     */
    public function index()
    {
        return view('frontend.user.dashboard')
            ->withUser(access()->user());
    }

    public function about()
    {
        return view('static.about');
    }

    public function howWork()
    {
        return view('static.howWork');
    }

    public function cumCumpar()
    {
        return view('static.cumCumpar');
    }

    public function cumVand()
    {
        return view('static.cumVand');
    }
}
