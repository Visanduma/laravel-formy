<?php

Route::group([],function(){
    Route::match(['post','patch'],'formy/submit', [\Visanduma\LaravelFormy\Controllers\FormController::class,'handleSubmit'])->name('formy.form-submit');

    Route::post('formy/file/delete', [\Visanduma\LaravelFormy\Controllers\FilePondController::class,'handleDelete'])->name('formy.delete-file');

    Route::any('formy/filepond',[\Visanduma\LaravelFormy\Controllers\FilePondController::class,'handleUpload'])->name('formy.file-upload');

    Route::get('formy/search',[\Visanduma\LaravelFormy\Controllers\FormController::class,'searchModel'])->name('formy.search-model');

    Route::post('formy/update-dependents',[\Visanduma\LaravelFormy\Controllers\FormController::class,'updateDependents']);

    Route::post('formy/create-resource',[\Visanduma\LaravelFormy\Controllers\FormController::class,'createResource']);

    Route::post('formy/refresh-input',[\Visanduma\LaravelFormy\Controllers\FormController::class,'refreshInput']);

});


