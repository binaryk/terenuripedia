<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Terrain extends Model
{
    protected $guarded = ['_token','id_tip_caracteristici'];

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

	public static function tip(){
    	return [
    		'' => '-- Alege --',
    		'1' =>	'Terenurile cu destinatie agricola',
    		'2' =>	'Terenurile cu destinatie forestiera',
    		'3' =>	'Terenurile aflate permanent sub ape',
    		'4' =>	'Terenurile din intravilan',
    		'5' =>	'Terenurile din extravilan',
    		'6' =>	'Terenurile cu destinatie speciala ',

    	];
    }
    public static function locatie(){
    	return 
    	[
			'' => '-- Alege --',
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


}
