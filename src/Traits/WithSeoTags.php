<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Traits;

use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Support\Str;

trait WithSeoTags
{
    /** @var int */
    protected $maxDescriptionLength = 170;

    /** @var int */
    protected $currentPage = 1;

    public function seo(array $params = []): void
    {
        $params = array_merge([
            'title'       => '',
            'description' => '',
            'routeName'   => '',
            'routeArg'    => '',
            'image'       => '',
        ], $params);

        $this->currentPage = $params['page'] ?? 1;

        $this->setTitle($params['title']);

        $this->setDescription($params['description']);

        $this->setCanonical($params['routeName'], $params['routeArg'], $params[$params['routeArg']] ?? '');

        $this->setImage($params['image']);
    }

    public function setTitle(?string $title = ''): void
    {
        $title = trim($title ?? '');

        if (empty($title)) {
            return;
        }

        if ($this->currentPage > 1) {
            $title .= ' - ' . __('pagination.page', [
                'page' => $this->currentPage,
            ]);
        }

        SEOTools::setTitle($title);
    }

    public function setDescription(?string $description = ''): void
    {
        $description = Str::limit(strip_tags($description ?? ''), $this->maxDescriptionLength);

        if (empty($description)) {
            return;
        }

        SEOTools::setDescription($description);
    }

    public function setCanonical(string $routeName, string $routeArg = '', string $routeArgValue = ''): void
    {
        if (empty($routeName)) {
            return;
        }

        $url = !empty($routeArg) && !empty($routeArgValue)
            ? route($routeName, [ $routeArg => $routeArgValue ])
            : route($routeName);

        SEOTools::setCanonical($url);

        OpenGraph::setUrl($url);
    }

    public function setImage(?string $image): void
    {
        if (!$image) {
            return;
        }

        SEOTools::addImages($image);
    }
}
