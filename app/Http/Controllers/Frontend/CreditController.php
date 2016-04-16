<?php namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Response;


class CreditController extends Controller
{

	public function __construct(){
	}

    public function index()
    {
        return view('credit.index')->withUser(access()->user())->with(compact('intpart','fraction'));
    }

    public function simulare($suma)
    {
        auth()->user()->credit += (float)$suma;
        auth()->user()->save();
        return redirect()->to('/credit');
    }




}