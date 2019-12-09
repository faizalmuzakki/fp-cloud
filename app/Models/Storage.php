<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StorageType{
    const types = [
        0 => [
            'name' => 'Small',
            'spacemb' => 50,
            'type_code' => 0,
        ],
        1 => [
            'name' => 'Medium',
            'spacemb' => 100,
            'type_code' => 1,
        ],
        2 => [
            'name' => 'Large',
            'spacemb' => 200,
            'type_code' => 2,
        ],
    ];
}

class Storage extends Model
{
    protected $fillable = [
        'user_id', 'type', 'used_space',
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }
}
