<?php

namespace Visanduma\LaravelFormy\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;

class FormController extends Controller
{
    private $formClass;
    private $className;

    public function __construct()
    {
        
        if (! app()->runningInConsole()) {
            
            $this->className = decrypt(request()->get('_form'));
            $this->formClass = new $this->className();

            // apply middlewares
            $excluded = array_diff(config('formy.middlewares'), $this->formClass->withoutFormMiddlewares());

            $this->middleware(array_merge($excluded, $this->formClass->formMiddlewares()));

        }
    }

    public function handleSubmit(Request $request)
    {
        $verify = \Illuminate\Support\Facades\Hash::check($this->className, $request->get('_hash'));

        if (! $verify) {
            throw new Exception('Form verification fail');
        }

        // inject uploaded files if any
        $this->formClass->injectFiles();

        if ($request->get('_model')) {
            return $this->formClass->update($request);
        }

        return $this->formClass->store($request);
    }

    public function searchModel(Request $request)
    {
        $query = $request->get('q');

        $input = ($this->formClass)->inputsWithKey()[$request->get('input')];

        if ($input->searchFunction) {
            return call_user_func($input->searchFunction, $query)
                ->map(function ($item) use ($input) {
                    return [
                        'value' => $item[$input->keyColumn],
                        'text' => $item[$input->valueColumn],
                    ];
                })
                ->toArray();
        }

        return [];
    }

    public function updateDependents(Request  $request)
    {
        $input = ($this->formClass)->inputsWithKey()[$request->get('input')];
        $type = $request->input('type','dependencyCallback');


        if ($input->$type) {
            return call_user_func($input->$type, $request->input('value'));
        }

        return [];
    }

    public function createResource(Request $request)
    {
        $request->validate([
            'content' => 'required'
        ]);

        $input = ($this->formClass)->inputsWithKey()[$request->get('input')];

        if ($input->createCallback) {
            return call_user_func($input->createCallback, $request->input('content'));
        }

        return [];
    }

    public function refreshInput(Request $request)
    {

        $input = ($this->formClass)->inputsWithKey()[$request->get('input')];

        return $input->getVueComponentData();

    }
}
