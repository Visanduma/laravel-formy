<?php


namespace Visanduma\LaravelFormy\Traits;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Visanduma\LaravelFormy\Models\FormyMedia;

trait HasFormyMedia
{
    public function media()
    {
        return $this->morphMany(FormyMedia::class,'owner');
    }

    public function addMediaFromRequest()
    {
        $request = request();
        foreach($request->allFiles() as $f){
            $path = $f->store( config('formy.media.upload_path'),config('formy.media.disk'));

            $this->media()->create([
                'original_filename' => $f->getClientOriginalName(),
                'filename' => $f->getFileName(),
                'path' => $path,
                'mime' => $f->getMimeType(),
                'disk' => config('formy.media.disk')
            ]);

            // todo remove temp file after file moved

        }

    }
}
