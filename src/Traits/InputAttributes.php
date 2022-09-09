<?php


namespace Visanduma\LaravelFormy\Traits;


use Visanduma\LaravelFormy\Inputs\BaseInput;

trait InputAttributes
{
    protected array $attributes = [];
    public string $label;
    protected string $helpText = "";
    protected array $classes = [];


    public function getLabelClass()
    {
        return implode(" ",$this->labelClass);
    }

    public function getParentClass()
    {
        return implode(" ",$this->parentClass);
    }

    /**
     * Remove attribute from input
     * @param $attribute
     * @return self
     */
    protected function removeAttribute($attribute):self
    {
        unset($this->attributes[$attribute]);
        return $this;
    }

    /**
     * Remove css class from input
     * @param $class
     * @return self
     */
    protected function removeClass($class):self
    {
        unset($this->classes[$class]);
    }

    /**
     * Set attrbute to input
     * @param $attribute
     * @param string $value
     * @return self
     */
    public function setAttribute($attribute, $value = ""):self
    {
        $this->attributes[$attribute] = $value;
        return $this;
    }

    /**
     * Add css class to input label
     * @param $class
     */
    protected function addLabelClass($class):void
    {
        $this->labelClass[] = $class;
    }

    /**
     * Set input id attribute. default attribute value will be lowercase of input name ex: formy-log_title
     * @param null $id
     * @return self
     */
    public function setId($id = null):self
    {
        $this->setAttribute('id',$id ?? "formy-".$this->getAttribute('name'));
        return $this;
    }

    /**
     * Get specific input attribute value
     * @param $name
     * @param string $default
     * @return string
     */
    public function getAttribute($attribute, $default = ""):string
    {
        return $this->attributes[$attribute] ?? $default;
    }

    public function setName($name)
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

    public function setValue($value)
    {
        $this->setAttribute('value', old($this->getAttribute('name'),$value));
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

    public function isFileInput():bool
    {
        return $this->getAttribute('type') == 'file';
    }

    public function getName()
    {
        return $this->getAttribute('name');
    }

    public function attributesArray()
    {
        return $this->attributes;
    }
}
