<?php


Route::post('formy/submit', function (\Illuminate\Http\Request $request) {

    // TODO: move logic to controller

    $class = decrypt($request->get('_form'));
    $verify = \Illuminate\Support\Facades\Hash::check($class, $request->get('_hash'));

    if(!$verify){
        throw new Exception('Form verification fail');
    }

    $bb = new $class();

    if($request->get('_model')){
        return $bb->update($request);
    }
    return $bb->store($request);

})->middleware('web')->name('formy.form-submit');

Route::any('formy/filepond',[\Visanduma\LaravelFormy\Controllers\FilePondController::class,'handleUpload'])->name('formy.file-upload');
