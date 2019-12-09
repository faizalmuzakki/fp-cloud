<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StorageType;

class UpgradeController extends Controller
{
    public function index(){
        return response()->json(StorageType::types);
    }

    public function update(Request $request){
        try {
            $user = $request->user();
            $user->storage->type = $request->upgrade_to;
            $user->storage->save();

        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Internal Server Error'
            ], 500);
        }

        return response()->json([
            'message' => 'Storage upgraded'
        ], 201);
    }
}
