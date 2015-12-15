<?php
/**
 * Created by PhpStorm.
 * User: cristi
 * Date: 11/22/2015
 * Time: 6:04 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Characteristic extends Model
{
    protected $table = 'characteristics';
    protected $guarded=[];
    public static function get(){
        return [0=>'--Alege--']+self::lists('name','id')->toArray();
    }
}