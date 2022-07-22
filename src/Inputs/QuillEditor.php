<?php


namespace Visanduma\LaravelFormy\Inputs;


class QuillEditor extends BaseInput
{
    private $options = [];

    public static function make($label, $name = ""): QuillEditor
    {
        $ins = new static($label, $name);
        $ins->height(200);

        return $ins;
    }


    public function html($theme)
    {
        $this->setAttribute('id','formy-quill-editor');
        $this->setOption('theme','snow');

        return $this->inputView('quill-editor-input',$theme);
    }

    public function options()
    {
        return $this->options;
    }

    public function setOption($name,$value)
    {
        $this->options[$name] = $value;
    }

    public function disable()
    {
        $this->setOption('readOnly',true);
        return $this;
    }

    public function placeholder($text)
    {
        $this->setOption('placeholder',$text);
        return $this;
    }

    public function height($value)
    {
        // TODO: handle multiple style appending
        $this->setAttribute('style',"min-height: {$value}px;");
        return $this;
    }


}
