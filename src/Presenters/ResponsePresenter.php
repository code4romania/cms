<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Presenters;

class ResponsePresenter extends Presenter
{
    public function form(): string
    {
        return $this->model->form->title ?? '–';
    }

    public function created_at(): string
    {
        return $this->model->created_at->toCookieString();
    }
}
