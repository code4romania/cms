<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Presenters;

use Code4Romania\Cms\Models\CityLab;
use Code4Romania\Cms\Models\Form;
use Code4Romania\Cms\Models\Partner;
use Code4Romania\Cms\Models\Person;
use Leewillis77\CachedEmbed\CachedEmbed;

/**
 * Presenter for frontend block components
 *
 * @package Code4Romania\Cms\Presenters
 */
class BlockPresenter extends Presenter
{

    /**
     * Block: callToAction
     */
    public function callToActionStyle(): string
    {
        $props = [
            'background_color' => 'background-color',
            'text_color' => 'color',
        ];

        return collect($props)
            ->map(function ($propName, $inputName): string {
                $value = $this->model->input($inputName);

                if (!is_null($value)) {
                    return sprintf('%s:%s;', $propName, $value);
                }

                return '';
            })
            ->implode('');
    }

    /**
     * Block: cityLabs
     */
    public function cityLabsListPublished()
    {
        $ids = $this->model->browserIds('cityLabs');

        return CityLab::publishedInListings()
            ->withActiveTranslations()
            ->orderByIds($ids)
            ->findMany($ids);
    }

    /**
     * Block: embed
     */
    public function embedCode(): ?string
    {
        try {
            $embed = CachedEmbed::create(
                $this->model->input('url'),
                config('cms.embeds.args'),
                config('cms.embeds.expiry')
            );
            return $embed->code;
        } catch (\Exception $exception) {
            return null;
        }
    }

    /**
     * Block: form
     */
    public function formPublished()
    {
        return Form::query()
            ->publishedInListings()
            ->withActiveTranslations()
            ->with('blocks')
            ->find($this->model->input('form'));
    }

    /**
     * Block: formField
     */
    public function formFieldAttributes(): string
    {
        $attributes = collect();

        if ($this->model->input('required')) {
            $attributes->push('required');
        }

        if ($this->model->input('minLength')) {
            $attributes->push(
                sprintf('minlength="%d"', $this->model->input('minLength'))
            );
        }

        if ($this->model->input('maxLength')) {
            $attributes->push(
                sprintf('maxlength="%d"', $this->model->input('maxLength'))
            );
        }

        if ($this->model->input('minValue')) {
            $attributes->push(
                sprintf('min="%d"', $this->model->input('minValue'))
            );
        }

        if ($this->model->input('maxValue')) {
            $attributes->push(
                sprintf('max="%d"', $this->model->input('maxValue'))
            );
        }

        if ($this->model->input('minDate')) {
            $attributes->push(
                sprintf('min="%s"', $this->model->input('minDate'))
            );
        }

        if ($this->model->input('maxDate')) {
            $attributes->push(
                sprintf('max="%s"', $this->model->input('maxDate'))
            );
        }

        return $attributes->join(' ');
    }

    /**
     * Block: people
     */
    public function peopleListPublished()
    {
        $ids = $this->model->browserIds('people');

        return Person::query()
            ->publishedInListings()
            ->orderByIds($ids)
            ->findMany($ids);
    }

    /**
     * Block: partners
     */
    public function partnersListPublished()
    {
        $ids = $this->model->browserIds('partners');

        return Partner::query()
            ->publishedInListings()
            ->orderByIds($ids)
            ->findMany($ids);
    }
}
