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

})->name('formy.form-submit');

Route::any('formy/filepond',function(\Illuminate\Http\Request $request){

    $rootDir =  "formy/temp-uploads";

    if($request->isMethod('post')){

        $file = $request->file('filepond');
        $dir = strtolower(\Illuminate\Support\Str::random());
        $file->storeAs("$rootDir/$dir/",$file->getClientOriginalName());

        return $dir;
    }
    if($request->isMethod('delete')){
        $dir = $request->getContent();
        \Illuminate\Support\Facades\Storage::deleteDirectory("$rootDir/$dir");
        return "DELETED";
    }

})->name('formy.file-upload');
