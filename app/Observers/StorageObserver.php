<?php

namespace App\Observers;

use App\Models\File;
use App\Models\Storage as StorageModel;

class StorageObserver
{
    public function deleting(StorageModel $storage){
        $delete = File::where('user_id', $storage->user_id)->delete();
    }
}
