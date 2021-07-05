<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Presenters;

use Code4Romania\Cms\Models\CityLab;
use Code4Romania\Cms\Models\Form;
use Code4Romania\Cms\Models\Partner;
use Code4Romania\Cms\Models\Person;
use Embed\Embed;
use Embed\Extractor;
use Illuminate\Support\Facades\Cache;

/**
 * Presenter for frontend block components
 *
 * @package Code4Romania\Cms\Presenters
 */
class BlockPresenter extends Presenter
{
    /**
     * Block: cityLabs
     */
    public function cityLabsListPublished()
    {
        $ids = $this->model->browserIds('cityLabs');

        return CityLab::query()
            ->publishedInListings()
            ->withActiveTranslations()
            ->orderByIds($ids)
            ->findMany($ids);
    }

    /**
     * Block: embed
     */
    public function embed(): ?Extractor
    {
        $url = $this->model->input('url');

        if (!$url) {
            return null;
        }

        try {
            return Cache::remember('embed-' . $url, config('cms.embeds.expiry'), function () use ($url) {
                // Grab the embed data.
                $data = (new Embed)->get($url);

                // Pre-load image attribute in the object to save work later.
                // Otherwise we have to redo the image extraction every time, rather than just once before caching.
                $data->image;

                return $data;
            });
        } catch (\Exception $exception) {
            return null;
        }
    }

    /**
     * Block: embed
     */
    public function embedCode(): ?string
    {
        return $this->embed()->code->html ?? null;
    }

    /**
     * Block: embed
     */
    public function embedAspectRatio(): ?string
    {
        $embed = $this->embed()->code ?? null;
        $closest = $ratio = null;

        if (is_null($embed) || is_null($embed->width) || is_null($embed->height)) {
            return null;
        }

        $search = round($embed->width / $embed->height, 3);

        foreach (config('cms.embeds.aspectRatio') as $name => $value) {
            if (is_null($closest) || abs($search - $closest) > abs($value - $search)) {
                $ratio   = $name;
                $closest = $value;
            }
        }

        return $ratio;
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

        /**
         * The spec currently dictates that @required directly relates to the
         * checkbox it is on, without consideration for others in the group.
         * Right now, any required checkbox must be ticked.
         *
         * @see https://www.w3.org/html/wg/tracker/issues/111
         */
        if ($this->model->input('required') && $this->model->input('type') !== 'checkbox') {
            $attributes->push('required');
        }

        if ($this->model->input('multiple')) {
            $attributes->push('multiple');
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
     * Block: formField
     */
    public function formFieldOptions(): array
    {
        return preg_split('/\r\n|\r|\n/', $this->model->translatedInput('options'));
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
