<?php


namespace Visanduma\LaravelFormy\Inputs;


use Illuminate\Support\Arr;
use Illuminate\Support\Str;

abstract class BaseInput
{
    public string $label;
    protected string $helpText = "";
    protected array $attributes = [];
    protected array $classes = [];
    protected bool $disabled = false;
    protected bool $invalid = false;
    protected string $errorMessage = "";
    protected bool $showOnUpdate = true;
    protected bool $showOnCreate = true;
    protected array $rules = [];
    private string $view;
    private $col = 12;
    private $singleLine = false;
    private $inline = false;
    private $parentClass = [];
    private $labelClass = [];
    private $wrapperClass = [];
    public $updateCallback = null;

    public function __construct($label, $name)
    {

        $this->setAttribute('name', $name ?: Str::snake($label));
        $this->setAttribute('label', ucfirst($label));
//        $this->addWrapperClass('mb-3');
        $this->addLabelClass('form-label');
        $this->id();
    }

    protected function setAttribute($name, $value = "")
    {
        $this->attributes[$name] = $value;
        return $this;
    }

    protected function addLabelClass($value)
    {
        $this->labelClass[] = $value;
    }

    public function id()
    {
        $this->setAttribute('id',"formy-".$this->getAttribute('name'));
        return $this;
    }

    public function getAttribute($name, $default = "")
    {
        return $this->attributes[$name] ?? $default;
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

    public function value($value)
    {
        $this->setAttribute('value', old($this->getAttribute('name'),$value));
        return $this;
    }

    public function bindUsing($cb)
    {
        $this->updateCallback = $cb;
        return $this;
    }

    public function defaultValue($data)
    {
        $this->value(call_user_func($this->updateCallback,$data));
        return $this;
    }


    public function disable()
    {
        $this->setAttribute('disabled',true); // TODO: handle disable attribue properly
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

    public function hasAttribute($name): bool
    {
        return array_key_exists($name, $this->attributes);
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

    protected function addClass($value)
    {
        $this->classes[] = $value;
    }

    public function attributesString():string
    {
        if(!$this->attributes) return '';

        $compiled = join('="%s" ', array_keys($this->attributes)).'="%s"';

        return vsprintf($compiled, array_map('htmlspecialchars', array_values($this->attributes)));
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

    public function displayOnUpdate():bool
    {
        return $this->showOnUpdate;
    }

    public function displayOnCreate():bool
    {
        return $this->showOnCreate;
    }

    public function width($number)
    {
        if(!$this->inline){
            $this->col = $number;
            $this->addWrapperClass("col-$number");
        }else{
            unset($this->parentClass[array_search('col-10',$this->parentClass)]);
            $this->addParentClass("col-$number");
        }

        return $this;
    }

    protected function addWrapperClass($value)
    {
        $this->wrapperClass[] = $value;
    }

    protected function addParentClass($value)
    {
        $this->parentClass[] = $value;
    }

    public function getLayoutColumn()
    {
        return $this->col;
    }

    public function singleLine($value=true)
    {
        $this->singleLine = $value;
        return $this;
    }

    public function onSingleLine()
    {
        return $this->singleLine;
    }

    public function inline()
    {
        $this->addWrapperClass('row');
        $this->addLabelClass('col-2');
        $this->addLabelClass('col-form-label');
        $this->addParentClass('col-10');
        $this->inline = true;
        return $this;
    }

    public function isInline()
    {
        return $this->inline;
    }

    public function getWrapperClass()
    {
        return implode(" ",$this->wrapperClass);
    }

    public function getLabelClass()
    {
        return implode(" ",$this->labelClass);
    }

    public function getParentClass()
    {
        return implode(" ",$this->parentClass);
    }

    protected function removeAttribute($name)
    {
        unset($this->attributes[$name]);
        return $this;
    }

    protected function removeClass($value)
    {
        unset($this->classes[$value]);
    }

    protected function view($name)
    {
        $this->view = $name;
    }

    protected function removeValueFrom($value,$array)
    {
        unset($array[array_search($value,$array)]);
    }

    protected function inputView($view,$theme,$data = [])
    {
        $data = array_merge($data,['input' => $this]);
        return view("formy::themes.$theme.$view", $data)->render();
    }

}
