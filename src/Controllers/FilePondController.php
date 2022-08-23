<?php

namespace Visanduma\LaravelFormy\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Visanduma\LaravelFormy\Handlers\FormyMediaHandler;
use Visanduma\LaravelFormy\Models\FormyMedia;

class FilePondController extends Controller
{
    private $handler;

    public function __construct()
    {
        $this->handler = new (config('formy.media.handler'));
    }

    public function handleUpload(Request $request)
    {
        return $this->handler->upload($request);
    }

    public function handleDelete(Request $request)
    {
        return $this->handler->delete($request);
    }
}
