<?php


namespace Visanduma\LaravelFormy\Traits;

use Illuminate\Support\Facades\Hash;
use Visanduma\LaravelFormy\Inputs\Button;

trait Wrapper
{
    private array $attributes = [];
    private array $classes = [];
    private $bindingData = [];
    private bool $isUpdate = false;
    private array $inputCollection = [];


    private function setAttribute($name, $value)
    {
        $this->attributes[$name] = $value;
        return $this;
    }

    private function getAttribute($name)
    {
        return $this->attributes[$name];
    }

    public function action($url)
    {
        $this->setAttribute('action', $url);
        return $this;
    }

    public function method($type)
    {
        $this->setAttribute('method', $type);
        return $this;
    }

    public function attributesString()
    {
        $list = "";
        foreach ($this->attributes as $k => $att) {
            $list .= $k . "=" . $att . " ";
        }
        return $list;
    }

    public function classString()
    {
        return implode("", $this->classes);
    }

    public function addClass($value)
    {
        $this->classes[] = $value;
    }

    public function removeClass($value)
    {
        unset($this->classes[$value]);
    }

    public function bindData($data)
    {
        $this->bindingData = $data;
        return $this;
    }

    private function bindInputs()
    {
        $this->inputCollection = $this->inputs();
        // TODO: improve this data binding
        if($this->bindingData){

            $this->config['submit-btn.text']  = $this->updateButtonText;

            foreach ($this->inputCollection as $input) {

                if($input->isFileInput()){
                    $this->bindFiles($input);
                    continue;
                }

                if($input->hasCustomBinding()){
                    $input->defaultValue($this->bindingData);
                    continue;
                }

                $input->setValue($this->bindingData[$input->getAttribute('name')] ?? "");
            }
        }
    }

    private function bindFiles($input)
    {
        $input->setFilesList(function(){
            $handler = new (config('formy.media.handler'));

            if($this->isUpdateForm()){
                return $handler->load($this->getModel());
            }

        });
    }

    public function getConfig($key = null)
    {

        return $key ? $this->config[$key] : $this->config;
    }

    protected function beforeBinding()
    {

    }

    protected function afterBinding()
    {

    }

    private function compileHtml()
    {
        $html = "";

        $totalCols = 0;
        foreach ($this->inputCollection as $key=>$input) {

            $col = $input->getLayoutColumn();
            $row_prefix = "";
            $row_suffix = "";

            // row managment
            if($totalCols == 0){
                $row_prefix = "<div class='row'>";
            }

            $totalCols += $col;

            if($totalCols == 12 || $input->onSingleLine() || $key + 1 == count($this->inputCollection)){
                $row_suffix = "</div>";
                $totalCols = 0;
            }


            if($this->isUpdate && $input->isVisibleOnUpdate() ||  !$this->isUpdate){
                $html .= $row_prefix.$input->html($this->theme,$this->model).$row_suffix;
            }

        }

        return $html;
    }

    private function generateFormButtons()
    {
        $buttons = [
            Button::make('Submit')
                ->addClass('btn btn-primary')
                ->setAttribute('@click','submit')
                ->setAttribute(':disabled','form.processing')
                ->setAttribute('hasSpinner',true)
                ->html($this->theme),

            Button::make('Reset')
                ->addClass('btn btn-light')
                ->setAttribute('@click','reset')
                ->html($this->theme),
        ];

        return implode("",$buttons);
    }

    private function getFormSubmitUrl()
    {
        $class = get_called_class();

        return  route('formy.form-submit', [
            '_form' => encrypt($class),
            '_hash' => Hash::make($class),
            '_model' => optional($this->getModel())->getKey() ?? null
        ]);
    }

    public function render()
    {
        $this->beforeBinding();

        $this->bindInputs();

        $this->afterBinding();

        $this->setAttribute('action',$this->getFormSubmitUrl());

        $html = $this->compileHtml();

        return view('formy::form')
            ->with('html', $html)
            ->with('form', $this)
            ->render();
    }

    public function toInertia()
    {
        $comps = [];
        $formInputs = [];

        foreach ($this->inputs() as $inp){

            if($inp->relation ?? null){
                $inp->fillRelationData($this->model);
            }

            $formInputs[$inp->getName()] = $this->bindingData[$inp->getName()] ?? '';
            $comps[] = $inp->getVueComponentData();

        }

        return [
            'components' => $comps,
            'url' => $this->getFormSubmitUrl(),
            'inputs' => $formInputs,
            'isUpdateForm' => $this->isUpdateForm()
        ];
    }

}
