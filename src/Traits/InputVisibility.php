<?php


namespace Visanduma\LaravelFormy\Traits;


use phpDocumentor\Reflection\Types\This;

trait InputVisibility
{
    protected bool $showOnUpdate = true;
    protected bool $showOnCreate = true;

    /**
     * Hide input on update view with condition
     * @param callable $callback
     * @return self
     */
    public function hideIf(callable $callback):self
    {
        $this->showOnUpdate = call_user_func($callback);
        return $this;
    }

    /**
     * Hide input on update view
     * @return self
     */
    public function hideOnUpdate():self
    {
        $this->showOnUpdate = false;
        return $this;
    }

    /**
     * Hide input on create view
     * @return self
     */
    public function hideOnCreate():self
    {
        $this->showOnCreate = false;
        return $this;
    }

    /**
     * Show input on update view
     * @return self
     */
    public function showOnUpdate():self
    {
        $this->showOnUpdate = true;
        return $this;
    }

    /**
     * Show input on create view
     * @return self
     */
    public function showOnCreate():self
    {
        $this->showOnCreate = true;
        return $this;
    }

    /**
     * @return bool
     */
    public function isVisibleOnUpdate():bool
    {
        return $this->showOnUpdate;
    }

    /**
     * @return bool
     */
    public function isVisibleOnCreate():bool
    {
        return $this->showOnCreate;
    }
}
