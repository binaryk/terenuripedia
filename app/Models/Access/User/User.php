<?php

namespace App\Models\Access\User;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use App\Models\Access\User\Traits\UserAccess;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Auth\Passwords\CanResetPassword;
use App\Models\Access\User\Traits\Attribute\UserAttribute;
use App\Models\Access\User\Traits\Relationship\UserRelationship;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

/**
 * Class User
 * @package App\Models\Access\User
 */
class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable,
    CanResetPassword,
    SoftDeletes,
    UserAccess,
    UserRelationship,
        UserAttribute;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id','password_confirmation'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * For soft deletes
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * @return mixed
     */
    public function canChangeEmail()
    {
        return config('access.users.change_email');
    }

    /**
     * @return mixed
     */
    public function canChangePassword()
    {
        return !app('session')->has(config('access.socialite_session_name'));
    }

    /**
     * @return bool
     */
    public function isBanned()
    {
        return $this->status == 2;
    }

    /**
     * @return bool
     */
    public function isDeactivated()
    {
        return $this->status == 0;
    }

    public static function insertRecord($data )
    {
        return self::create($data);
    }

    public static function category()
    {
        return ['buyer' => '3','saller' => '4'];
    }

    public static function type()
    {
        return [
            '1' => 'Proprietar',// - asignat cu culoarea albastra
            '2' => 'Broker',// - Galben
            '3' => 'Banca',// - Rosu
        ];
    }

    public static function color()
    {
        switch(auth()->user()->type_id){
            case 1:
                return '#0D9AEC';
            break;
            case 2:
                return '#ECBC0D';
            break;
            case 3:
                return '#EC0D0D';
            break;
        }
        return '#000';
    }
}
