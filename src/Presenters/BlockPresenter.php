<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Presenters;

use Code4Romania\Cms\Models\CityLab;
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
