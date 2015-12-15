<?php namespace App\Http\Controllers\Frontend\Payment;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Response;


class PayReplayController extends Controller
{
    private $mid = '';
    private $key = '';

    public function __construct(){
//		parent::__construct();
        $this->mid="44840981036";
        $this->key="449F4097648AE750FD9CDF105EC178B6D0DCFFB0";
    }

    public function replay($data = [])
    {
        $key=$this->key;
        $zcrsp =  array (
            'amount'     => addslashes(trim(@Input::get('amount'))),  //original amount
            'curr'       => addslashes(trim(@Input::get('curr'))),    //original currency
            'invoice_id' => addslashes(trim(@Input::get('invoice_id'))),//original invoice id
            'ep_id'      => addslashes(trim(@Input::get('ep_id'))), //Euplatesc.ro unique id
            'merch_id'   => addslashes(trim(@Input::get('merch_id'))), //your merchant id
            'action'     => addslashes(trim(@Input::get('action'))), // if action ==0 transaction ok
            'message'    => addslashes(trim(@Input::get('message'))),// transaction responce message
            'approval'   => addslashes(trim(@Input::get('approval'))),// if action!=0 empty
            'timestamp'  => addslashes(trim(@Input::get('timestamp'))),// meesage timestamp
            'nonce'      => addslashes(trim(@Input::get('nonce'))),
        );
        
        User::where('id',1)->update(['ok_pay' => 123]);
        return \Response::json(['data' => Input::all()]);
        dd(Input::all());
        $zcrsp['fp_hash'] = strtoupper($this->euplatesc_mac($zcrsp, $key));
        $fp_hash=addslashes(trim(@Input::get('fp_hash')));
        if($zcrsp['fp_hash']===$fp_hash)	{
            // start facem update in baza de date
            if($zcrsp['action']!="0") {

                echo "Successfully completed";
            }
            else {
                echo "Tranzaction failed" . $zcrsp['message'];
            }
            // end facem update in baza de date
        }
        else {
            echo "Invalid signature";
        }
    }

    function hmacsha1($key,$data) {
        $blocksize = 64;
        $hashfunc  = 'md5';

        if(strlen($key) > $blocksize)
            $key = pack('H*', $hashfunc($key));

        $key  = str_pad($key, $blocksize, chr(0x00));
        $ipad = str_repeat(chr(0x36), $blocksize);
        $opad = str_repeat(chr(0x5c), $blocksize);

        $hmac = pack('H*', $hashfunc(($key ^ $opad) . pack('H*', $hashfunc(($key ^ $ipad) . $data))));
        return bin2hex($hmac);
    }
// ===========================================================================================
    function euplatesc_mac($data, $key = NULL)
    {
        $str = NULL;

        foreach($data as $d)
        {
            if($d === NULL || strlen($d) == 0)
                $str .= '-'; // valorile nule sunt inlocuite cu -
            else
                $str .= strlen($d) . $d;
        }

        $key = pack('H*', $key);

        return $this->hmacsha1($key, $str);
    }

}