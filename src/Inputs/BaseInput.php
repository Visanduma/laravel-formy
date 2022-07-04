<?php


namespace Visanduma\LaravelFormy\Inputs;


use Illuminate\Support\Str;

abstract class BaseInput
{
    public string $label;
    protected string $helpText = "";
    protected array $attributes = [];
    protected array $classes = [];
    protected bool $disabled = false;
    private string $view;
    protected bool $invalid = false;
    protected string $errorMessage = "";
    public bool $showOnUpdate   = true;
    public bool $showOnCreate   = true;
    protected array $rules = [];

    public function __construct($label, $name)
    {

        $this->setAttribute('name', $name ?: Str::snake($label));
        $this->setAttribute('label', ucfirst($label));
        $this->id();
    }

    public function name($name)
    {
        $this->setAttribute('name', $name);
        return $this;
    }

    public function getLabel():string
    {
        return $this->getAttribute('label');
    }
    public function placeholder($value)
    {
        $this->setAttribute('placeholder', $value);
        return $this;
    }

    public function id()
    {
        $this->setAttribute('id',"formy-".$this->getAttribute('name'));
        return $this;
    }

    public function value($value)
    {
        $this->setAttribute('value', old($this->getAttribute('name'),$value));
        return $this;
    }

    public function disable()
    {
        $this->setAttribute('disabled');
        return $this;
    }

    public function maxLength($length)
    {
        $this->setAttribute('maxLength', $length);
        return $this;
    }

    public function helpText($value)
    {
        $this->setAttribute('helpText', $value);
        return $this;
    }

    protected function setAttribute($name, $value = "")
    {
        $this->attributes[$name] = $value;
        return $this;
    }

    protected function addClass($value)
    {
        $this->classes[] = $value;
    }

    protected function removeClass($value)
    {
        unset($this->classes[$value]);
    }

    protected function view($name)
    {
        $this->view = $name;
    }

    public function hasAttribute($name): bool
    {
        return array_key_exists($name, $this->attributes);
    }

    public function getAttribute($name, $default = "")
    {
        return $this->attributes[$name] ?? $default;
    }

    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    public function isInvalid($message = "")
    {
        $this->addClass('is-invalid');
        $this->errorMessage = $message;
        return $this;
    }

    public function attributesString():string
    {
        $str="";

        foreach ($this->attributes as $key=>$attr){
            if(!empty($attr)){
                $str.=  $key."=".$attr." "; // TODO string with spaces not works
            }else{
                $str.= $key." ";
            }
        }

        return $str;
    }

    public function classString():string
    {
        return implode(" ", $this->classes);
    }

    public function rules($rules)
    {
        if(is_array($rules)){
            $this->rules = $rules;
        }else{
            $this->rules = explode('|',$rules);
        }
        return $this;
    }

    public function getRules()
    {
        return $this->rules;
    }

    public function hideIf(callable $callback)
    {
        $this->showOnUpdate = call_user_func($callback);
        return $this;
    }
}
