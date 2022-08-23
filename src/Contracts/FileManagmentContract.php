<?php


namespace Visanduma\LaravelFormy\Contracts;


use Illuminate\Http\Request;

interface FileManagmentContract
{
    public function upload(Request $request);

    public function delete(Request $request);

    public function load($modal);

}
