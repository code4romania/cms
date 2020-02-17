<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Presenters;

use Code4Romania\Cms\Presenters\Presenter;
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
     *
     * @return string
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
     * Block: embed
     *
     * @return null|string
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
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Block: imageText
     *
     * @return string
     */
    public function imageTextContainerClass(): string
    {
        $containerClass = [];

        switch ($this->model->input('width')) {
            case '1/4':
                $containerClass[] = 'md:grid-cols-4';
                break;

            case '1/3':
                $containerClass[] = 'md:grid-cols-3';
                break;

            case '1/2':
                $containerClass[] = 'md:grid-cols-2';
                break;
        }

        switch ($this->model->input('valign')) {
            case 'top':
                $containerClass[] = 'items-start';
                break;

            case 'center':
                $containerClass[] = 'items-center';
                break;

            case 'bottom':
                $containerClass[] = 'items-end';
                break;
        }

        return implode(' ', $containerClass);
    }

    /**
     * Block: imageText
     *
     * @return string
     */
    public function imageTextImageClass(): string
    {
        $imageClass = ['col-span-1'];

        switch ($this->model->input('width')) {
            case '1/4':
                $inverseClass = 'md:col-start-4';
                break;

            case '1/3':
                $inverseClass = 'md:col-start-3';
                break;

            case '1/2':
                $inverseClass = 'md:col-start-2';
                break;
        }

        if (isset($inverseClass) && $this->model->input('position') == 'right') {
            $imageClass[] = $inverseClass ?? '';
        }

        return implode(' ', $imageClass);
    }

    /**
     * Block: imageText
     *
     * @return string
     */
    public function imageTextContentClass(): string
    {
        $contentClass = [];

        switch ($this->model->input('width')) {
            case '1/4':
                $contentClass[] = 'md:col-span-3';
                break;

            case '1/3':
                $contentClass[] = 'md:col-span-2';
                break;

            case '1/2':
                $contentClass[] = 'md:col-span-1';
                break;
        }

        return implode(' ', $contentClass);
    }
}
