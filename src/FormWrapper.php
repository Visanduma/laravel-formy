<?php


namespace Visanduma\LaravelFormy;



use Illuminate\Support\Facades\Hash;

class FormWrapper
{
    private array $inputs = [];
    private array $attributes = [];
    private array $classes = [];
    private $bindingData = [];
    private $formClass;
    private bool $isUpdate = false;


    public static function make($inputs,$class)
    {
        return new self($inputs,$class);
    }

    public function __construct($inputs,$class)
    {
        $this->inputs = $inputs;
        $this->formClass = $class;
        $this->setAttribute('method', 'post');
    }

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
        $this->isUpdate = true;
        return $this;
    }

    private function bindInputs()
    {
        if($this->bindingData){
            foreach ($this->inputs as $input) {
                $input->value($this->bindingData[$input->getAttribute('name')]);
            }
        }
    }

    public function render()
    {
        $this->bindInputs();

        $this->setAttribute('action', route('formy::form-submit', [
            '_form' => encrypt($this->formClass),
            '_hash' => Hash::make($this->formClass),
            '_model' => optional($this->bindingData)->getKey() ?? null
        ]));

        $html = "";
        foreach ($this->inputs as $input) {
            if($this->isUpdate && $input->showOnUpdate){
                $html .= $input->html();
            }
            if(!$this->isUpdate){
                $html .= $input->html();
            }

        }

        return view('form.form')
            ->with('html', $html)
            ->with('form', $this)
            ->render();
    }

}
