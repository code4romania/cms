<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Presenters;

use Illuminate\Support\Collection;

class PostPresenter extends Presenter
{
    public function publishDate(): string
    {
        return ($this->model->publish_start_date ?? $this->model->created_at)
            ->isoFormat(__('date.format'));
    }

    public function categories(): Collection
    {
        return $this->model->categories
            ->map(function ($category) {
                return [
                    'title' => $category->title,
                    'url'   => route('front.categories.show', ['slug' => $category->slug]),
                ];
            });
    }
}
