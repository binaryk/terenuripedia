<?php

/**
 * Created by PhpStorm.
 * User: cristi
 * Date: 11/22/2015
 * Time: 6:24 PM
 */
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Role, App\Models\User, App\Models\Contact, App\Models\Post, App\Models\Tag, App\Models\PostTag, App\Models\Comment;
use App\Services\LoremIpsumGenerator;

class CharacteristicSeeder extends Seeder
{
    public static function caracteristici(){
        return [
            '1'	   => 'acces drum asfaltat',
            '2'	   => 'apa curenta,',
            '3'	   => 'autorizatie constructie,',
            '4'	   => 'cadastru, canalizare,',
            '5'	   => 'certificat de urbanismn,',
            '6'	   => 'energie electrica,',
            '7'	   => 'intabulare,',
            '8'	   => 'liber pentru contstructii,',
            '9'	   => 'parcelabil,',
            '10'   => 'racord gaz,',
            '11'   => 'teren ingradit',
        ];
    }

    public function run(){

        DB::table('characteristics')->truncate();
        foreach (self::caracteristici() as $caracteristica) {
            \App\Models\Characteristic::create([
                'name' => $caracteristica
            ]);
        }
    }
}