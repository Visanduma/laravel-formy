<?php


namespace Visanduma\LaravelFormy;


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


    public function __construct()
    {
        $this->setAttribute('method', 'post');
    }

    public static function updateForm($modelKey)
    {
        $ins = new static();
        $ins->modelKey = $modelKey;
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

    public function bind($data)
    {
        $this->data = $data;
        return $this;
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
        $this->bind($this->getModel());
        $this->config['btn.text']  = $this->updateButtonText;
    }

    private function getModel()
    {
        if (!$this->model::exists($this->modelKey)) {
            throw new ModelNotFoundException();
        }

        return $this->model::find($this->modelKey);
    }

    public function getValidationRules(): array
    {
        $rr = [];
        foreach ($this->inputs() as $input) {
            $rr[$input->getAttribute('name')] = $input->getRules();
        }

        return $rr;
    }

    public function getValidationAttributeLabels(): array
    {
        $rr = [];
        foreach ($this->inputs() as $input) {
            $rr[$input->getAttribute('name')] = $input->getLabel();
        }

        return $rr;
    }
}
