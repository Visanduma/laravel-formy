<?php


namespace Visanduma\LaravelFormy\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class FormController extends Controller
{
    private $formClass,$className;

    public function __construct()
    {
        $this->className = decrypt(request()->get('_form'));
        $this->formClass = new $this->className();

        // apply middlewares
        $excluded = array_diff(config('formy.middlewares'),$this->formClass->withoutFormMiddlewares());

        $this->middleware(array_merge($excluded,$this->formClass->formMiddlewares()));

    }

    public function handleSubmit(Request $request)
    {

        $verify = \Illuminate\Support\Facades\Hash::check($this->className, $request->get('_hash'));

        if (!$verify) {
            throw new Exception('Form verification fail');
        }

        // inject uploaded files if any
        $this->formClass->injectFiles();

        if ($request->get('_model')) {
            return $this->formClass->update($request);
        }
        return $this->formClass->store($request);
    }


}
