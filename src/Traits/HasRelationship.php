<?php


namespace Visanduma\LaravelFormy\Traits;


trait HasRelationship
{
    public $relation = null;
    public string $labelColumn;

    public function useRelation($name,$labelColumn = 'name')
    {
        $this->relation = $name;
        $this->labelColumn = $labelColumn;

        return $this;
    }

    public function getRelationData($model)
    {
        if($this->relation){

            $model = new $model();

            if(method_exists($model,$this->relation)){
                $ims = $model->{$this->relation}()->getModel()->all();
                return $ims->pluck( $this->labelColumn, $model->getKeyName() )->toArray();
            }else{
                throw new \Exception("Unknown relationship `{$this->relation}`");
            }

        }
    }

    public function fillRelationData($model)
    {
        $this->options($this->getRelationData($model));
    }
}
