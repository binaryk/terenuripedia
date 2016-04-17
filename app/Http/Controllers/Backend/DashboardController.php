<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Access\User\User;

/**
 * Class DashboardController
 * @package App\Http\Controllers\Backend
 */
class DashboardController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        if(auth()->user()->hasRole('Administrator')){
            User::credit(200);
        }
        return view('backend.dashboard');
    }
}
