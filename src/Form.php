<?php


namespace Visanduma\LaravelFormy;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Visanduma\LaravelFormy\Controllers\FilePondController;
use Visanduma\LaravelFormy\Traits\Wrapper;

class Form
{
    use Wrapper;

    protected $data;
    public $modelKey;
    protected $model;
    private $config;
    protected $disableResetButton = false;
    protected $disableSubmitButton = false;
    private $validationMessages = [];
    protected array $customData = [];

    protected string $createButtonText = "Create";
    protected string $updateButtonText = "Update";
    protected string $resetButtonText = "Reset";
    protected $theme = "bootstrap5";
    protected $submitButtonClass = "btn btn-primary";
    protected $resetButtonClass = "btn btn-light";
    protected $middlewares = [];
    protected $withoutMiddlewares = [];


    public function __construct()
    {
        $this->setAttribute('method', 'post');

        $this->config['submit-btn.text']  = $this->createButtonText;
        $this->config['reset-btn.text']  = $this->resetButtonText;
        $this->config['reset-btn.class']  = $this->resetButtonClass;
        $this->config['submit-btn.class']  = $this->submitButtonClass;
        $this->config['reset-btn.disabled']  = $this->disableResetButton;
        $this->config['submit-btn.disabled']  = $this->disableSubmitButton;

        $this->setup();

    }

    public static function updateForm($model)
    {
        // TODO: improve model detection
        $ins = new static();

        if($model instanceof Model){
            $ins->modelKey = $model->getKey();
        }else{
            $ins->modelKey = $model;
        }

        return $ins->updateView();
    }

    public static function createForm()
    {
        return new static();
    }


    protected function inputs()
    {
        return [];
    }

    public function inputsNames()
    {
        $nm = [];
        foreach ($this->inputs() as $inp) {
            $nm[] = $inp->getAttribute('name');
        }

        return $nm;
    }

    public function inputsWithKey()
    {
        return collect($this->inputs())->mapWithKeys(function($item){

            return [
                $item->getName() => $item
            ];

        })->toArray();
    }

    public function updateView()
    {
        $this->bindData($this->setBindingModel());
        $this->isUpdate = true;
        $this->config['submit-btn.text']  = $this->updateButtonText;
        $this->config['reset-btn.disabled']  = true;

        return $this;
    }

    protected function setBindingModel()
    {
        return $this->getModel();
    }

    public function getModel()
    {
        if(request()->isMethod('post')){
            $key = request()->get('_model');
        }else{
            $key = $this->modelKey;
        }

        if($this->model::exists($key)){
            return $this->model::find($key);
        }


        return $this->model;


    }

    public function getValidationRules(): array
    {

        $rr = [];
        foreach ($this->inputs() as $input) {
            $rr[$input->getAttribute('name')] = $input->getRules();
        }

        return array_filter($rr);
    }

    public function getValidationAttributeLabels(): array
    {
        $rr = [];
        foreach ($this->inputs() as $input) {
            $rr[$input->getAttribute('name')] = $input->getLabel();
        }

        return array_filter($rr);
    }

    public function validate()
    {
        request()->validate($this->getValidationRules(),[],$this->getValidationAttributeLabels());
    }

    public function hasValidInputs()
    {
        $vd = validator(request()->all(),$this->getValidationRules(),[],$this->getValidationAttributeLabels());
        $this->validationMessages = $vd->errors()->messages();
        return !$vd->fails();
    }

    public function getValidationMessages()
    {
        return $this->validationMessages;
    }

    public function withData(array $data)
    {
        $this->customData = $data;
        return $this;
    }

    public function getData($key = null)
    {
        if($key && array_key_exists($key,$this->customData)){
            return $this->customData[$key];
        }

        return $this->customData;
    }

    public function updateEntity($except = [])
    {
        $inputs = request()->only($this->inputsNames());

        return $this->getModel()->update(array_diff($inputs,$except));
    }

    public function createEntity($except = [])
    {
        $inputs = request()->only($this->inputsNames());

        return $this->model::create(array_diff($inputs,$except));
    }

    public function injectFiles()
    {

        foreach ($this->inputs() as $input){
            $inputName = $input->getAttribute('name');

            if($input->isFileInput() && request()->get($inputName)){

                request()->files->set( $inputName,
                    new \Illuminate\Http\UploadedFile(storage_path("app/".config('formy.media.temp_path')."/".request()->get($inputName)),request()->get($inputName)),
                );

            }
        }
    }

    public function uploadFiles()
    {

    }

    /**
     * Setup form configuration before build it
     */
    protected function setup():void
    {
        // setup form
    }

    public function isUpdateForm():bool
    {
        return $this->isUpdate;
    }

    public function isCreateForm():bool
    {
        return !$this->isUpdate;
    }

    /**
     *  Disable form submit button
     */
    public function disableFormSubmit():void
    {
        $this->config['submit-btn.disabled']  = true;

    }

    public function formMiddlewares():array
    {
        return $this->middlewares;
    }

    public function withoutFormMiddlewares():array
    {
        return $this->withoutMiddlewares;
    }

}
