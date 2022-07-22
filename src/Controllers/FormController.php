<?php


namespace Visanduma\LaravelFormy\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function handleSubmit(Request $request)
    {
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
    }
}
