<?php


namespace Visanduma\LaravelFormy\Traits;

use Illuminate\Support\Facades\Hash;

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

    public function onSubmit($callback)
    {
        call_user_func($callback);
    }

    public function bindData($data)
    {
        $this->bindingData = $data;
        return $this;
    }

    private function bindInputs()
    {
        // TODO: improve this data binding
        if($this->bindingData){
            $this->config['btn.text']  = $this->updateButtonText;
            foreach ($this->inputCollection as $input) {
                $input->value($this->bindingData[$input->getAttribute('name')]);
            }
        }
    }

    public function getConfig($key = null)
    {

        return $key ? $this->config[$key] : $this->config;
    }

    public function render()
    {
        $this->bindInputs();
        $class = get_called_class();

        $this->setAttribute('action', route('formy.form-submit', [
            '_form' => encrypt($class),
            '_hash' => Hash::make($class),
            '_model' => optional($this->bindingData)->getKey() ?? null
        ]));

        $html = "";

        foreach ($this->inputCollection as $input) {
            if($this->isUpdate && $input->displayOnUpdate()){
                $html .= $input->html();
            }
            if(!$this->isUpdate){
                $html .= $input->html();
            }

        }

        return view('formy::form')
            ->with('html', $html)
            ->with('form', $this)
            ->render();
    }

}
