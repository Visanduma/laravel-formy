<?php


namespace Visanduma\LaravelFormy;


use App\Models\User;
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
    protected string $createButtonText = "Create";
    protected string $updateButtonText = "Update";
    protected string $resetButtonText = "Reset";
    private $validationMessages = [];
    protected $theme = "bootstrap5";
    protected $submitButtonClass = "btn btn-primary";
    protected $resetButtonClass = "btn btn-light";
    protected $disableResetButton = false;
    protected array $customData = [];


    public function __construct()
    {
        $this->setAttribute('method', 'post');

        $this->config['submit-btn.text']  = $this->createButtonText;
        $this->config['reset-btn.text']  = $this->resetButtonText;
        $this->config['reset-btn.class']  = $this->resetButtonClass;
        $this->config['submit-btn.class']  = $this->submitButtonClass;
        $this->config['reset-btn.disabled']  = $this->disableResetButton;

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
        foreach ($this->inputs() as $ip) {
            $nm[] = $ip->getAttribute('name');
        }

        return $nm;
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
        if($key){
            return $this->customData[$key];
        }

        return $this->customData;
    }

    public function updateEntity()
    {
        return $this->getModel()->update(request()->only($this->inputsNames()));
    }

    public function createEntity()
    {
        return $this->model::create(request()->only($this->inputsNames()));
    }

    public function injectFiles()
    {
        foreach ($this->inputs() as $input){

            $inputName = $input->getAttribute('name');

            if($input->getAttribute('type') == 'file' && request()->get($inputName)){
                request()->files->set( $inputName,
                    new \Illuminate\Http\UploadedFile(storage_path("app/".FilePondController::ROOT_DIR."/".request()->get($inputName)),request()->get($inputName)),
                );
            }
        }
    }

}
