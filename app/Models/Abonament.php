<?php

namespace App\Models;

use App\Binaryk\Model\BModel;
use Illuminate\Database\Eloquent\Model;

class Abonament extends BModel
{

    protected $table = "abonamente";
    protected $guardes = [];


    public function user()
    {
        return $this->belongsTo('\App\Models\Access\User\User','user_is');
    }





}