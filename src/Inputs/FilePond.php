<?php


namespace Visanduma\LaravelFormy\Inputs;


class FilePond extends BaseInput
{
    private $options = [];

    public static function make($label, $name = ""): FilePond
    {
        $ins = new static($label, $name);
        $ins->setAttribute('type','file');
//        $ins->setAttribute('name',$ins->getAttribute('name')."[]");
        $ins->setOption('server', route('formy.file-upload'));
        $ins->setOption('name','filepond');

        return $ins;
    }


    public function html()
    {

        return view('formy::inputs.filepond-input', [
            'input' => $this,
        ])->render();
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
        $this->setOption('disabled',true);
        return $this;
    }

    public function multipe()
    {
//        $this->setAttribute('multiple');
        $this->setOption('allowMultiple',true);
        return $this;
    }


}
