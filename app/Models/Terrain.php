<?php

namespace App\Models;

use App\Binaryk\Model\BModel;
use Illuminate\Database\Eloquent\Model;
use App\Models\UnlokedTerrain;
class Terrain extends BModel
{


    protected $guarded = ['_token','id_tip_caracteristici', 'user_owner'];

    public static function createRecord($data)
    {
        if(self::where('id',$data['terrain_id'])->count() > 0){
            self::where('id',$data['terrain_id'])->update([
                'photo'      => $data['path'] . $data['file']
            ]);
            return self::find($data['terrain_id']);
        }else{
            return "Nu exista teren cu acest id";
        }

    }

	public function owner()
	{
		return $this->belongsTo('\App\Models\Access\User\User','user_id');
	}

    public function coords(){
    	return $this->hasMany('\App\Models\TerrainCoord', 'terrain_id');
    }

	public function characteristics(){
		return $this->belongsToMany('App\Models\Characteristic', 'characteristics_terrain', 'id_terrain', 'id_characteristics');
	}

	public function openedForCurrentUser($id){
		if(! auth()->user()){
			return 0;
		}
        if(self::find($id)->user_id == auth()->user()->id){
            return 1;
        }
		return UnlokedTerrain::where('user_id', auth()->user()->id)->where('terrain_id', $id)->count();
	}

	public static function tip(){
    	return [
    		'' => 'Alege tipul de teren ',
    		'1' =>	'Terenurile din intravilan',
    		'2' =>	'Terenurile din extravilan',

    	];
    }

	public static function destinatie(){
    	return [
    		'' => 'Alege destinatia terenului ',
			'1' => 'agrement',
			'2' => 'forestier',
			'3' => 'industrial',
			'4' => 'mixt',
			'5' => 'retail',
			'6' => 'rezidential',
//    		'1' =>	'Terenurile cu destinatie agricola',
//    		'2' =>	'Terenurile cu destinatie forestiera',
//    		'3' =>	'Terenurile aflate permanent sub ape',
//    		'4' =>	'Terenurile cu destinatie speciala',

    	];
    }

	public static function front(){
    	return [
    		'1' =>	'Da',
    		'2' =>	'Nu',
    	];
    }



    public function localitate()
    {
        return $this->belongsTo('\App\Models\Localitate', 'id_locatie');
    }

    public static function locatie(){
//		$localitati = Localitate::lists('id','localitate');
//		dd($localitati);
/*        $out = [];

        foreach(Localitate::all() as $localitate){
            $out[$localitate->id] = $localitate->localitate;
        }

       return $out;*/

    	return 
    	[
    	'' => 'Alege localitatea',
			'1' => 'Bucuresti sectorul 1',
			'2' => 'Bucuresti sectorul 2',
			'3' => 'Bucuresti sectorul 3',
			'4' => 'Bucuresti sectorul 4',
			'5' => 'Bucuresti sectorul 5',
			'6' => 'Bucuresti sectorul 6',
			'7' => 'Alba',
			'8' => 'Arad',
			'9' => 'Arges',
			'10' => 'Bacau',
			'11' => 'Bihor',
			'12' => 'Bistrita Nasaud',
			'13' => 'Botosani',
			'14' => 'Braila',
			'15' => 'Brasov',
			'16' => 'Buzau',
			'17' => 'Calarasi',
			'18' => 'Caras Severin',
			'19' => 'Cluj',
			'20' => 'Constanta',
			'21' => 'Covasna',
			'22' => 'Dambovita',
			'23' => 'Dolj',
			'24' => 'Galati',
			'25' => 'Giurgiu',
			'26' => 'Gorj',
			'27' => 'Harghita',
			'28' => 'Hunedoara',
			'29' => 'Ialomita',
			'30' => 'Iasi',
			'31' => 'Ilfov',
			'32' => 'Maramures',
			'33' => 'Mehedinti',
			'34' => 'Mures',
			'35' => 'Neamt',
			'36' => 'Olt',
			'37' => 'Prahova',
			'38' => 'Salaj',
			'39' => 'Satu Mare',
			'40' => 'Sibiu',
			'41' => 'Suceava',
			'42' => 'Teleorman',
			'43' => 'Timis',
			'44' => 'Tulcea',
			'45' => 'Valcea',
			'46' => 'Vaslui',
			'47' => 'Vrancea',
    	];
			
    }


	public static function generalValidatorRules($array = [])
	{
		return [
			/*AppServiceProvider ==> custom rules*/
			'title'   			      => 'required|min:50',
			'id_tip_caracteristici'   => 'required|not_in:0',
			'id_locatie'   			  => 'required|not_in:0',
			'pret'   				  => 'required|not_in:0',
			'suprafata'   				  => 'required|not_in:0',
		];
	}

	public static function generalValidatorMessages()
	{
		return [
			'title.required'        			  => 'Titlul anuntului trebuie completat.',
			'title.min'        			  => 'Titlul anuntului trebuie sa aiba minim 50 caractere.',
	/*		'id_tip_caracteristici.required'      => 'Caracteristicile trebuiesc completate.',
			'id_tip_caracteristici.not_in'        => 'Caracteristicile trebuiesc completate.',*/
			'id_locatie.required'        		  => 'Locatia trebuie completata.',
			'id_locatie.not_in'        			  => 'Locatia trebuie completata.',
			'pret.required'        				  => 'Pretul trebuie completat.',
			'pret.not_in'        				  => 'Pretul trebuie sa fie mai mare ca 0 (zero).',
			'suprafata.required'        		  => 'Suprafata trebuie completata.',
			'suprafata.not_in'        			  => 'Suprafata trebuie sa fie mai mare ca 0 (zero).',
		];
	}

	public static function bigestPrice($priceOnly = false)
	{
        $node = self::orderBy('pret', 'desc')->first();
        if($node){
            return $priceOnly ? $node : $node->pret;
        }
		return 0;
	}

	public static function biggestArea($ariaOnly = false)
	{
        $node = self::orderBy('suprafata', 'desc')->first();
        if($node){
            return $ariaOnly ? $node : floatval($node->suprafata);
        }
		return 0;
	}

	public function photos()
	{
		return $this->hasMany('App\Models\Photo','terrain_id');
	}


}
