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
     * Block: counter
     */
    public function counterBadgeBackgroundClass(): string
    {
        $classes = collect();

        switch ($this->model->input('background')) {
            case 'primary':
                $classes->push('text-white');
                break;

            case 'warning':
                $classes->push('text-black');
                break;

            case 'danger':
                $classes->push('text-white');
                break;

            case 'gray':
                $classes->push('text-white');
                break;

            default:
                break;
        }

        return $classes->implode(' ');
    }

    /**
     * Block: counter
     */
    public function counterBadgeTextClass(): string
    {
        $classes = collect();

        switch ($this->model->input('background')) {
            case 'primary':
                $classes->push('text-primary-700');
                break;

            case 'warning':
                $classes->push('text-warning-400');
                break;

            case 'danger':
                $classes->push('text-danger-700');
                break;

            case 'gray':
                $classes->push('text-gray-800');
                break;

            default:
                $classes->push('text-white');
                break;
        }

        return $classes->implode(' ');
    }

    /**
     * Block: counter
     */
    public function counterColumnsClass(): string
    {
        $classes = collect();

        switch ($this->model->input('columns')) {
            case 1:
                $classes->push('grid-cols-1');
                break;

            case 2:
                $classes->push('grid-cols-2');
                break;

            case 3:
                $classes->push('grid-cols-2 lg:grid-cols-3');
                break;

            default:
                break;
        }

        return $classes->implode(' ');
    }

    /**
     * Block: counter
     */
    public function counterContainerClass(): string
    {
        $classes = collect();

        switch ($this->model->input('background')) {
            case 'primary':
                $classes->push('bg-primary-700');
                $classes->push('text-white');
                break;

            case 'warning':
                $classes->push('bg-warning-400');
                $classes->push('text-black');
                break;

            case 'danger':
                $classes->push('bg-danger-700');
                $classes->push('text-white');
                break;

            case 'gray':
                $classes->push('bg-gray-800');
                $classes->push('text-white');
                break;

            default:
                break;
        }

        return $classes->implode(' ');
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
     * Block: imageText
     */
    public function imageTextContainerClass(): string
    {
        $classes = collect();

        switch ($this->model->input('width')) {
            case '1/4':
                $classes->push('md:grid-cols-4');
                break;

            case '1/3':
                $classes->push('md:grid-cols-3');
                break;

            case '1/2':
                $classes->push('md:grid-cols-2');
                break;
        }

        switch ($this->model->input('valign')) {
            case 'top':
                $classes->push('items-start');
                break;

            case 'center':
                $classes->push('items-center');
                break;

            case 'bottom':
                $classes->push('items-end');
                break;
        }

        return $classes->implode(' ');
    }

    /**
     * Block: imageText
     */
    public function imageTextContentClass(): string
    {
        $classes = collect('rich-text');

        switch ($this->model->input('width')) {
            case '1/4':
                $classes->push('md:col-span-3');
                break;

            case '1/3':
                $classes->push('md:col-span-2');
                break;

            case '1/2':
                $classes->push('md:col-span-1');
                break;
        }

        return $classes->implode(' ');
    }

    /**
     * Block: imageText
     */
    public function imageTextImageClass(): string
    {
        $classes = collect(['col-span-1']);

        if ($this->model->input('position') === 'right') {
            switch ($this->model->input('width')) {
                case '1/4':
                    $classes->push('md:col-start-4');
                    break;

                case '1/3':
                    $classes->push('md:col-start-3');
                    break;

                case '1/2':
                    $classes->push('md:col-start-2');
                    break;
            }
        }

        return $classes->implode(' ');
    }

    /**
     * Block: people
     */
    public function peopleColumnsClass(): string
    {
        $classes = collect();

        switch ($this->model->input('columns')) {
            case 2:
                $classes->push('sm:grid-cols-2');
                break;

            case 3:
                $classes->push('sm:grid-cols-2 lg:grid-cols-3');
                break;

            case 4:
                $classes->push('sm:grid-cols-2 lg:grid-cols-4');
                break;

            default:
                break;
        }

        return $classes->implode(' ');
    }

    /**
     * Block: people
     */
    public function peopleListPublished()
    {
        $ids = $this->model->browserIds('people');

        return Person::publishedInListings()
            ->orderByIds($ids)
            ->findMany($ids);
    }

    /**
     * Block: partners
     */
    public function partnersColumnsClass(): string
    {
        $classes = collect();

        switch ($this->model->input('columns')) {
            case 2:
                $classes->push('sm:grid-cols-2');
                break;

            case 3:
                $classes->push('sm:grid-cols-2 lg:grid-cols-3');
                break;

            case 4:
                $classes->push('sm:grid-cols-2 lg:grid-cols-4');
                break;

            default:
                break;
        }

        return $classes->implode(' ');
    }

    /**
     * Block: partners
     */
    public function partnersListPublished()
    {
        $ids = $this->model->browserIds('partners');

        return Partner::publishedInListings()
            ->orderByIds($ids)
            ->findMany($ids);
    }
}
