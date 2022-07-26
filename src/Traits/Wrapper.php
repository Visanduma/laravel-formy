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
        $this->inputCollection = $this->inputs();

        // TODO: improve this data binding
        if($this->bindingData){
            $this->config['submit-btn.text']  = $this->updateButtonText;
            foreach ($this->inputCollection as $input) {
                if($input->hasCustomBinding()){
                    $input->defaultValue($this->bindingData);
                }else{
                    $input->value($this->bindingData[$input->getAttribute('name')]);
                }
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


            if($this->isUpdate && $input->displayOnUpdate() ||  !$this->isUpdate){
                $html .= $row_prefix.$input->html($this->theme).$row_suffix;
            }

        }

        return view('formy::form')
            ->with('html', $html)
            ->with('form', $this)
            ->render();
    }

}
