<?php


namespace Visanduma\LaravelFormy\Traits;


use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Visanduma\LaravelFormy\Models\FormyMedia;

trait HasFormyMedia
{
    public function media()
    {
        return $this->morphMany(FormyMedia::class,'owner');
    }

    public function saveMediaFilesFromRequest()
    {
        $request = request();

        foreach($request->allFiles() as $f){

            $this->storeMediaFile($f,config('formy.media.upload_path','formy-media'));

        }

    }

    public function storeMediaFile(UploadedFile $file,$path)
    {

            $tempFilename = Str::random(20).microtime().".".$file->getClientOriginalExtension();

            $savedPath = $file->storeAs($path,$tempFilename,config('formy.media.disk', 'local'));

            $this->media()->create([
                'original_filename' => $file->getClientOriginalName(),
                'filename' => $tempFilename,
                'path' => $savedPath,
                'mime' => $file->getMimeType(),
                'disk' => config('formy.media.disk')
            ]);
    }

    public function mediaArray()
    {
        return $this->media->map(function($file){

            return [
                'id' => $file->id,
                'preview' =>  Storage::disk()->url($file->path),
                'path' => $file->path
            ];

        })->toArray();
    }
}
