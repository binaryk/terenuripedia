<?php namespace App\Http\Controllers\Frontend\Payment;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use App\User;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Response;


trait Calculator
{
    protected $subscription = NULL;
    protected $price        = 0;
    protected $per          = NULL;
    protected $percent      = NULL;


    public function calculate($id, $per, $percentaj)
    {
        $this->per = $per;
        $this->percent =  $percentaj;
        $this->subscription = Subscription::find($id);

        if(auth()->user()->hasRole(config('access.roles.saller'))){
            $type = auth()->user()->type_id;

            if($type == 2){
                /*regulile cu minim ==> Borker*/
                $this->price = $this->broker();
            }else{
                /*reguli normale*/
                $this->price = $this->normal();

            }


        }

        return $this->price;
    }

    public function normal()
    {
        switch($this->subscription->id){
            case 1:
                /*free*/
                return 0;
                break;
            case 2:
                /*STANDARD*/
                $this->price = $this->per1();
                break;
            case 3:
                /*AVANSAT*/
                $this->price = $this->avansat();
                break;
        }
        return $this->price;
    }

    public function per1()
    {
        switch($this->per){
            case 1:
                /*an*/
                return 48;
                break;
            case 2:
                /*luna*/
                return 4;
                break;
            case 3:
                /*semestru*/
                return 32;
                break;
        }
    }

    public function avansat()
    {
        switch($this->percent){
            case 5:
                return 2 * 48 - 0.05 * (6*48);
                break;
            case 10:
                return 6 * 48 - 0.1 * (6*48);
                break;
            case 15:
                return 11 * 48 - 0.15 * (6*48);
                break;
            case 20:
                return 16 * 48 - 0.2 * (6*48);
                break;
        }
    }

    public function broker()
    {
        switch($this->per){
            case 1:
                /*pe an*/
                return $this->per_subscription(1);
                break;
            case 2:
                /*pe luna*/
                return $this->per_subscription(2);
                break;
        }
        return 1;
    }

    public function per_subscription($per)
    {
        switch($this->subscription->id){
            case 1:
                /*free*/
                return 0;
                break;
            case 2:
                /*STANDARD*/
                return $per == 1 ? 432 : 36;
                break;
            case 3:
                /*AVANSAT*/
                return $per == 1 ? 1920 : 160;
                break;
        }
    }

}