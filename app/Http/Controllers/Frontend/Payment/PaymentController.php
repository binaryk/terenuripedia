<?php namespace App\Http\Controllers\Frontend\Payment;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Response;


class PaymentController extends Controller
{
	use Calculator;
	private $mid = '';
	private $key = ''; 

	public function __construct(){
//		parent::__construct();
		$this->mid="44840981036";
		$this->key="449F4097648AE750FD9CDF105EC178B6D0DCFFB0";
	}

	public function post()
	{
		return redirect()->route('auth.profile.payment');

	}

	public function index($subscription = '1', $per = '1'){
        $subscription = Input::get('abonament');
        $percentaj    = Input::get('procent');
        $per          = Input::get('per');
        $price        = 1;
		/*aici o sa calculez in functie de $subscription (abonament) ce pret are abonamentul*/
		if($subscription){
			$price = $this->calculate($subscription,$per, $percentaj);
		}else{
			/*face o simpla incarcare de cont*/
		}
		$dataAll = array(
				'amount'      => $price,  //suma de plata
				'curr'        => 'RON',                                                   // moneda de plata
				'invoice_id'  => str_pad(substr(mt_rand(), 0, 7), 7, '0', STR_PAD_LEFT),  // numarul comenzii este generat aleator. inlocuiti cuu seria dumneavoastra
				'order_desc'  => 'Factură privind achiziționarea abonamentului.',                                            //descrierea comenzii
	                     // va rog sa nu modificati urmatoarele 3 randuri
				'merch_id'    => $this->mid,                                                    // nu modificati
				'timestamp'   => gmdate("YmdHis"),                                        // nu modificati
	 			'nonce'       => md5(microtime() . mt_rand()),                            //nu modificati

	); 
	  
	  $dataAll['fp_hash'] = strtoupper($this->euplatesc_mac($dataAll,$this->key));

	//completati cu valorile dvs
	$dataBill = array(
				'fname'	   => auth()->user()->name,      // nume
				'lname'	   => auth()->user()->last_name,   // prenume
				'country'  => 'billing tara',      // tara
				'company'  => 'billing company',   // firma
				'city'	   => 'billing city',      // oras
				'add'	   => 'billing adresa',    // adresa
				'email'	   => auth()->user()->email,     // email
				'phone'	   => '',   // telefon
				'fax'	   => 'billing fax',       // fax
	);
	$dataShip = array(
				'sfname'       => auth()->user()->name,     // nume
				'slname'       => 'shipping prenume',  // prenume
				'scountry'     => 'shipping tara',     // tara
				'scompany'     => 'shipping company',  // firma
				'scity'	       => 'shipping city',     // oras
				'sadd'         => 'shipping add',      // adresa
				'semail'       => auth()->user()->email,    // email
				'sphone'       => 'shipping telefon',  // telefon
				'sfax'	       => 'shipping fax',      // fax
	);
		return view('frontend.payment.index' )->with(compact('dataAll','dataBill','dataShip','abonament'));
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
	function euplatesc_mac($data, $key)
	{
	  $str = NULL;

	  foreach($data as $d)
	  {
	   	if($d === NULL || strlen($d) == 0)
	  	  $str .= '-'; // valorile nule sunt inlocuite cu -
	  	else
	  	  $str .= strlen($d) . $d;
	  }
	     
	  // ================================================================
	  $key = pack('H*', $key); // convertim codul secret intr-un string binar
	  // ================================================================

	// echo " $str " ;

	  return $this->hmacsha1($key, $str);
	}




}