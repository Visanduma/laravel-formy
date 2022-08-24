<?php


namespace Visanduma\LaravelFormy\Traits;


trait InputValidation
{
    protected array $rules = [];

    /**
     * Set input validation rules
     * @param array|string $rules
     * @return $this
     */
    public function rules($rules):self
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
}
