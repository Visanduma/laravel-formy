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
        $this->className = decrypt(request()->get('_form'));
        $this->formClass = new $this->className();

        // apply middlewares
        $excluded = array_diff(config('formy.middlewares'), $this->formClass->withoutFormMiddlewares());

        $this->middleware(array_merge($excluded, $this->formClass->formMiddlewares()));
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

       return $input->searchModel::where($input->search_column,'like', "%$query%")
            ->select($input->search_column, $input->value_column)
            ->take($input->results_limit)
            ->get()
            ->toArray();

    }
}
