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
            '1'	   =>  'acces drum asfalt',
            '2'	   =>  'alimentare apa',
            '3'	   =>  'cadastru',
            '4'	   =>  'canalizare',
            '5'	   =>  'autoriz. construct.',
            '6'	   =>  'certificat urbanism',
            '7'	   =>  'constructie teren',
            '8'	   =>  'curent electric',
            '9'	   =>  'CUT',
            '10'   =>  'ingradit',
            '11'   =>  'intabulare',
            '12'   =>  'gaze',
            '13'   =>  'liber',
            '14'   =>  'parcelabil',
            '15'   =>  'POT',
            '16'   =>  'stradal',
            '17'   =>  'PUZ',
            '18'   =>  'PUD',
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