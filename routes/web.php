<?php


use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;

Route::group(['middleware' => config('formy.middlewares')],function(){
    Route::post('formy/submit', [\Visanduma\LaravelFormy\Controllers\FormController::class,'handleSubmit'])->name('formy.form-submit');

    Route::any('formy/filepond',[\Visanduma\LaravelFormy\Controllers\FilePondController::class,'handleUpload'])->name('formy.file-upload');
});


