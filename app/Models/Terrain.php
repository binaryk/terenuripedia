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
    		'' => 'Alege tipul de teren ',
    		'1' =>	'Terenurile cu destinatie agricola',
    		'2' =>	'Terenurile cu destinatie forestiera',
    		'3' =>	'Terenurile aflate permanent sub ape',
    		'4' =>	'Terenurile din intravilan',
    		'5' =>	'Terenurile cu destinatie speciala ',

    	];
    }
    public static function locatie(){
    	return 
    	[
    	'' => 'Alege localitatea',
    	'1' => 'Bucuresti sectorul 1',
    	'2' => 'Bucuresti sectorul 2',
    	'3' => 'Bucuresti sectorul 3',
    	'4' => 'Bucuresti sectorul 4',
    	'5' => 'Bucuresti sectorul 5',
    	'6' => 'Alba',
    	'7' => 'Arad',
    	'8' => 'Arges',
    	'9' => 'Bacau',
    	'10' => 'Bihor',
    	'11' => 'Bistrita Nasaud',
    	'12' => 'Botosani',
    	'13' => 'Braila',
    	'14' => 'Brasov',
    	'15' => 'Buzau',
    	'16' => 'Calarasi',
    	'17' => 'Caras Severin',
    	'18' => 'Cluj',
    	'19' => 'Constanta',
    	'20' => 'Covasna',
    	'21' => 'Dambovita',
    	'22' => 'Dolj',
    	'23' => 'Galati',
    	'24' => 'Giurgiu',
    	'25' => 'Gorj',
    	'26' => 'Harghita',
    	'27' => 'Hunedoara',
    	'28' => 'Ialomita',
    	'29' => 'Iasi',
    	'30' => 'Ilfov',
    	'31' => 'Maramures',
    	'32' => 'Mehedinti',
    	'33' => 'Mures',
    	'34' => 'Neamt',
    	'35' => 'Olt',
    	'36' => 'Prahova',
    	'37' => 'Salaj',
    	'38' => 'Satu Mare',
    	'39' => 'Sibiu',
    	'40' => 'Suceava',
    	'41' => 'Teleorman',
    	'42' => 'Timis',
    	'43' => 'Tulcea',
    	'44' => 'Valcea',
    	'45' => 'Vaslui',
    	'46' => 'Vrancea',
    	];
			
    } 


}
