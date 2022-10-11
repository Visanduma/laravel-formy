<?php

Route::group([],function(){
    Route::post('formy/submit', [\Visanduma\LaravelFormy\Controllers\FormController::class,'handleSubmit'])->name('formy.form-submit');

    Route::post('formy/file/delete', [\Visanduma\LaravelFormy\Controllers\FilePondController::class,'handleDelete'])->name('formy.delete-file');
    Route::any('formy/filepond',[\Visanduma\LaravelFormy\Controllers\FilePondController::class,'handleUpload'])->name('formy.file-upload');

    Route::get('formy/search',[\Visanduma\LaravelFormy\Controllers\FormController::class,'searchModel'])->name('formy.search-model');

});


