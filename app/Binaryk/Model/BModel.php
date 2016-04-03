<?php namespace App\Binaryk\Model;

class BModel extends \Illuminate\Database\Eloquent\Model
{


    public static function beforeCreate( $data )
    {
        return $data;
    }

    public static function afterCreate( $record, $data )
    {
        return $record;
    }

    public static function insertRecord( $data, $id = NULL)
    {
        $data   = static::beforeCreate($data);
        self::unguard();
        $record = self::create($data);
        $record = static::afterCreate($record, $data);
        return $record;
    }

    public static function beforeUpdate( $data )
    {
        return $data;
    }

    public static function afterUpdate( $record, $data )
    {
        return $record;
    }

    public static function updateRecord( $data, $id )
    {
        $record = static::find($id);
        if( ! $record )
        {
            throw new \Exception("Record not found", 1);
        }
        $data   = static::beforeUpdate($data);
        self::unguard();
        $record->update($data);
        $record = static::afterUpdate($record, $data);
        return $record;
    }

    public static function beforeDelete( $data )
    {
        return $data;
    }

    public static function afterDelete( $record, $data )
    {
        return $record;
    }

    public static function deleteRecord($data, $id)
    {
        $record = static::find($id);
        if( ! $record )
        {
            throw new \Exception("Record not found", 1);
        }
        $data   = static::beforeDelete($data);
        $record->delete();
        $record = static::afterDelete($record, $data);
        return $record;
    }

    public static function removeField($field, $data)
    {
        if( array_key_exists($field, $data) )
        {
            $data[$field] = NULL;
            unset($data[$field]);
        }
        return $data;
    }
}