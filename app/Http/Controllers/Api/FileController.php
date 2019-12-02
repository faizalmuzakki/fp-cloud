<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\File;
use Storage;

class FileController extends Controller
{
    public function index(){
        $files = \Auth::user()->files;

        return response()->json($files);
    }

    private function sizeInMB($size){
        $file_size = number_format($size / 1048576, 2);

        return $file_size;
    }

    public function store(Request $request){
        try {
            $file = $request->user()->files()
                    ->where('filename', $request->file('file')->getClientOriginalName())
                    ->first();

            if($request->hasFile('file') && !$file){
                $request->file('file')->storeAs(
                    $request->user()->id,
                    $request->file('file')->getClientOriginalName()
                );

                $create = File::create([
                    'filename' => $request->file('file')->getClientOriginalName(),
                    'sizemb' => $this->sizeInMB($request->file('file')->getSize()),
                    'user_id' => $request->user()->id,
                ]);
            }
            else
                return response()->json([
                    'message' => 'File not detected or filename already used'
                ], 404);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Internal Server Error'
            ], 500);
        }

        return response()->json([
            'message' => 'File uploaded'
        ], 201);
    }

    public function update(Request $request){
        try {
            $file = $request->user()->files()
                    ->where('filename', $request->filename)
                    ->firstOrFail();

            Storage::move(
                $request->user()->id.'/'.$request->filename,
                $request->user()->id.'/'.$request->name_change_to
            );

            $file->fill([
                'filename' => $request->name_change_to,
            ])->save();

        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'File not found'
            ], 404);
        }

        return response()->json([
            'message' => 'File updated'
        ], 201);
    }

    public function destroy(Request $request){
        try {
            $file = $request->user()->files()
                    ->where('filename', $request->filename)
                    ->firstOrFail()->delete();

            Storage::delete($request->user()->id.'/'.$request->filename);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Internal Server Error'
            ], 500);
        }

        return response()->json([
            'message' => 'File deleted'
        ], 201);
    }

    public function download(Request $request){
        try {
            $file = $request->user()->files()
                    ->where('filename', $request->filename)
                    ->firstOrFail();

        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'File Not Found'
            ], 500);
        }

        return response()->download(
            storage_path("app/".$request->user()->id."/".$file->filename)
        );
    }
}
