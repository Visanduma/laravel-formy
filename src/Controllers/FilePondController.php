<?php

namespace Visanduma\LaravelFormy\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FilePondController extends Controller
{
    private $handler;

    public function __construct()
    {
        $this->handler = new (config('formy.media.handler'));
        $this->middleware(config('formy.middlewares'));
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
