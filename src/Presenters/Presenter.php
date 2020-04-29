<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Presenters;

use Illuminate\Database\Eloquent\Model;

abstract class Presenter
{
    /** @var Model */
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Allow for property-style retrieval
     *
     * @return mixed
     */
    public function __get(string $property)
    {
        if (method_exists($this, $property)) {
            return $this->$property();
        }

        return $this->model->$property;
    }
}
