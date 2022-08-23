<?php


namespace Visanduma\LaravelFormy\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Visanduma\LaravelFormy\Models\FormyMedia;

class FormController extends Controller
{
    public function handleSubmit(Request $request)
    {
        $class = decrypt($request->get('_form'));
        $verify = \Illuminate\Support\Facades\Hash::check($class, $request->get('_hash'));

        if(!$verify){
            throw new Exception('Form verification fail');
        }

        $form = new $class();

        // inject uploaded files if any
        $form->injectFiles();

        if($request->get('_model')){
            return $form->update($request);
        }
        return $form->store($request);
    }


}
