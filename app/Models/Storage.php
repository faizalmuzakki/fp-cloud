<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StorageType{
    const types = [
        0 => [
            'name' => 'Small',
            'spacemb' => 50
        ],
        1 => [
            'name' => 'Medium',
            'spacemb' => 100
        ],
        2 => [
            'name' => 'Large',
            'spacemb' => 200
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
