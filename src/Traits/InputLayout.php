<?php


namespace Visanduma\LaravelFormy\Traits;


trait InputLayout
{
    private $col = 12;
    private $singleLine = false;
    private $inline = false;
    private $parentClass = [];
    private $labelClass = [];
    private $wrapperClass = [];


    /**
     * Set column width between 1 - 12
     * @param $number
     * @return self
     */
    public function width($number):self
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

    /**
     * Reserve row for only one input
     * @param bool $value
     * @return self
     */
    public function singleLine($value=true):self
    {
        $this->singleLine = $value;
        return $this;
    }

    public function onSingleLine():bool
    {
        return $this->singleLine;
    }

    /**
     * Make input inline with label
     * @return self
     */
    public function inline():self
    {
        $this->addWrapperClass('row');
        $this->addLabelClass('col-2');
        $this->addLabelClass('col-form-label');
        $this->addParentClass('col-10');
        $this->inline = true;

        return $this;
    }

    public function isInline():bool
    {
        return $this->inline;
    }

    public function getWrapperClass()
    {
        return implode(" ",$this->wrapperClass);
    }
}
