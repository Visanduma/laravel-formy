<?php


namespace Visanduma\LaravelFormy;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Visanduma\LaravelFormy\Traits\Wrapper;

class Form
{
    use Wrapper;

    protected $data;
    public $modelKey;
    protected string $model;
    private $config;
    protected string $createButtonText = "Create";
    protected string $updateButtonText = "Update";
    private $validationMessages = [];
    protected $theme = "bootstrap5";


    public function __construct()
    {
        $this->setAttribute('method', 'post');
        $this->config['btn.text']  = $this->createButtonText;
        $this->inputCollection = $this->inputs();

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

        $ins->updateView();
        return $ins;
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
        foreach ($this->inputCollection as $ip) {
            $nm[] = $ip->getAttribute('name');
        }

        return $nm;
    }

    public function updateView()
    {
        $this->bindData($this->getModel());
        $this->isUpdate = true;
        $this->config['btn.text']  = $this->updateButtonText;
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
        foreach ($this->inputCollection as $input) {
            $rr[$input->getAttribute('name')] = $input->getRules();
        }

        return array_filter($rr);
    }

    public function getValidationAttributeLabels(): array
    {
        $rr = [];
        foreach ($this->inputCollection as $input) {
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


}
