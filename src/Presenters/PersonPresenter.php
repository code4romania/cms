<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Presenters;

class PersonPresenter extends Presenter
{
    public function cityLab(): string
    {
        return $this->model->cityLab->first()->name ?? '–';
    }

    public function imageSrc(int $width = 96): string
    {
        if (!$this->model->hasImage('image')) {
            return $this->model->placeholder_avatar;
        }

        return $this->model->image('image', 'default', [
            'w' => $width
        ]);
    }

    public function imageLqip(): ?string
    {
        if (!$this->model->hasImage('image')) {
            return null;
        }

        return $this->model->lowQualityImagePlaceholder('image');
    }
}
