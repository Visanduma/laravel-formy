<?php


namespace Visanduma\LaravelFormy\Inputs;


use Illuminate\Support\Str;
use Visanduma\LaravelFormy\Traits\InputAttributes;
use Visanduma\LaravelFormy\Traits\InputLayout;
use Visanduma\LaravelFormy\Traits\InputValidation;
use Visanduma\LaravelFormy\Traits\InputVisibility;

/**
 * Class BaseInput
 * @package Visanduma\LaravelFormy\Inputs
 */
abstract class BaseInput
{

    use InputVisibility, InputLayout, InputAttributes, InputValidation;


    protected bool $disabled = false;
    protected bool $invalid = false;
    protected string $errorMessage = "";
    private string $view;
    private $updateCallback = null;
    public $files = [];

    public function __construct($label, $name)
    {

        $this->setAttribute('name', $name ?: Str::snake($label));
        $this->setAttribute('label', ucfirst($label));
        $this->addLabelClass('form-label');
        $this->setId();
    }


    /**
     * Customize data binding logic
     * @param $cb
     * @return $this
     */
    public function bindUsing($cb)
    {
        $this->updateCallback = $cb;
        return $this;
    }

    public function defaultValue($data)
    {
        $this->setValue(call_user_func($this->updateCallback, $data));
        return $this;
    }


    /**
     * Set input help text
     * @param $value
     *
     */
    public function helpText($value)
    {
        $this->setAttribute('helpText', $value);
        return $this;
    }

    /**
     * Check input has specific attribute
     * @param $name
     * @return bool
     */
    public function hasAttribute($name): bool
    {
        return array_key_exists($name, $this->attributes);
    }


    /**
     * Add css class to input
     * @param $value
     * @returns $this
     */
    public function addClass($value)
    {
        $this->classes[] = $value;

        return $this;
    }

    /**
     * Get all attributes as single string
     * @return string
     */
    public function attributesString(): string
    {
        if (!$this->attributes) return '';

        $compiled = join('="%s" ', array_keys($this->attributes)) . '="%s"';

        return vsprintf($compiled, array_map('htmlspecialchars', array_values($this->attributes)));
    }

    /**
     * Get all css classes as string
     * @return string
     */
    public function classString(): string
    {
        return implode(" ", $this->classes);
    }


    protected function view($name)
    {
        $this->view = $name;
    }

    protected function removeValueFrom($value, $array)
    {
        unset($array[array_search($value, $array)]);
    }

    protected function inputView($view, $theme, $data = [])
    {
        $data = array_merge($data, ['input' => $this]);
        return view("formy::themes.$theme.$view", $data)->render();
    }


    /**
     * Check input has custom data binding
     * @return bool
     */
    public function hasCustomBinding():bool
    {
        return !is_null($this->updateCallback);
    }




}
