<?php

namespace App\Observers;

use App\User;
use App\Models\Storage as StorageModel;

class UserObserver
{
    public function created(User $user){
        $create = StorageModel::create([
            'user_id' => $user->id,
            'type' => 0,
        ]);
    }

    public function deleting(File $file){
        $delete = StorageModel::where('user_id', $file->user_id)->delete();
    }
}
