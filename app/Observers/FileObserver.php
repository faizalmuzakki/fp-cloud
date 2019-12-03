<?php

namespace App\Observers;

use App\Models\File;
use App\Models\Storage as StorageModel;

class FileObserver
{
    public function creating(File $file){
        $storage = StorageModel::where('user_id', $file->user_id)->first();
        $storage->used_space += $file->sizemb;
        $storage->save();
    }

    public function deleting(File $file){
        $storage = StorageModel::where('user_id', $file->user_id)->first();
        $storage->used_space -= $file->sizemb;
        $storage->save();
    }
}
