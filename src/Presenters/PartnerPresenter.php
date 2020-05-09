<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Presenters;

class PartnerPresenter extends Presenter
{
    public function imageSrc(int $size = 400): ?string
    {
        if (!$this->model->hasImage('logo')) {
            return null;
        }

        return $this->model->image('logo', 'default', [
            'w' => $size
        ]);
    }
}
