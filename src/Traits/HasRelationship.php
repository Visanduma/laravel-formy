<?php


namespace Visanduma\LaravelFormy\Traits;


trait HasRelationship
{
    public string $relation;
    public string $labelColumn;

    public function useRelation($name,$labelColumn = 'name')
    {
        $this->relation = $name;
        $this->labelColumn = $labelColumn;

        return $this;
    }

    private function getRelationData($model)
    {
        if($this->relation){

            $model = new $model();

            if(is_callable([$model, $this->relation])){
                $ims = $model->{$this->relation}()->getModel()->all();
                $this->options  = $ims->pluck( $this->labelColumn, $model->getKeyName() )->toArray();
            }

        }
    }
}
