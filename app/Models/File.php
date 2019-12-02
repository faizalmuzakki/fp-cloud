<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = [
        'filename', 'user_id', 'sizemb',
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }
}
