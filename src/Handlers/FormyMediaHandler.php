<?php

namespace Visanduma\LaravelFormy\Handlers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Visanduma\LaravelFormy\Contracts\FileManagmentContract;
use Visanduma\LaravelFormy\Models\FormyMedia;

class FormyMediaHandler implements FileManagmentContract
{

    public function upload(Request $request)
    {
        $tempPath =  config('formy.media.temp_path');

        if($request->isMethod('post')){

            $file = Arr::flatten($request->allFiles())[0]; // proccess single file at once
            $filename = $file->getClientOriginalName()."_".time().".".$file->getClientOriginalExtension();
            
            $file->storeAs($tempPath,$filename);

            return $filename;
        }

        if($request->isMethod('delete')){
            $filename = $request->getContent();
            Storage::delete(config('formy.media.temp_path')."/$filename");

            return "DELETED";
        }
    }


    public function delete(Request $request)
    {

        if(FormyMedia::find($request->get('file'))){
            $md = FormyMedia::find($request->get('file'));
            // delete file on disk
            Storage::delete($md->path);

            $md->delete();

            return back();
        }

        return response()->json(['message' => 'Unable to remove file'],404);
    }

    public function load($modal)
    {
        if(!$modal){
            return [];
        }
        return $modal->media
            ->map(function($itm){
                return [
                    'id' => $itm->id,
                    'name' => $itm->original_filename,
                    'preview' => Storage::disk()->url($itm['path']),
                    'url' => Storage::disk()->url($itm['path']),
                ];
            });
    }

}
