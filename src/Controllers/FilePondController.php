<?php

namespace Visanduma\LaravelFormy\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FilePondController extends Controller
{
    const ROOT_DIR = "formy/temp-uploads";

    public function handleUpload(Request $request)
    {
        $rootDir =  self::ROOT_DIR;

        if($request->isMethod('post')){

            $file = Arr::first($request->allFiles());
            $filename = pathinfo($file->getClientOriginalName(),PATHINFO_FILENAME)."_".time().".".$file->getClientOriginalExtension();
            $filename = Str::snake($filename);
            $file->storeAs("$rootDir",$filename);

            return $filename;
        }

        if($request->isMethod('delete')){
            $filename = $request->getContent();
            Storage::delete("$rootDir/$filename");

            return "DELETED";
        }
    }
}
