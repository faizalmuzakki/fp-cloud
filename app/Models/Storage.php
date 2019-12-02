<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StorageType{
    public static $type0;
}

class Storage extends Model
{
    public function user(){
        return $this->belongsTo('App\User');
    }
}
