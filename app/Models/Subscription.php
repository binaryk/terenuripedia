<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscription extends Model
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'config_subscriptions';
    protected $primarykey = 'id';

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id_expense'];

    public static function getRecord( $id )
    {
        return self::find($id);
    }

    public static function createRecord($data )
    {
        return self::create($data);
    }

    public static function updateRecord($id, $data)
    {
        $record  = self::find($id);
        $record->update($data);
        if( ! $record )
        {
            return false;
        }
        return $record;
    }

    public static function deleteRecord($id, $data)
    {
        $record = self::find($id);
        if( ! $record )
        {
            return false;
        }
        return $record->delete();
    }

    public static function toCombobox()
    {
        return ['0' => 'Selectati tipul de abonament'] +  self::lists('name','id')->toArray();
    }

}

