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

            $file = Arr::flatten($request->allFiles())[0];
            $filename = Str::random()."_".time().".".$file->getClientOriginalExtension();
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
