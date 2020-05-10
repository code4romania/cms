<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Tests\Helpers;

use Code4Romania\Cms\Helpers\UrlHelper;
use Code4Romania\Cms\Repositories\PageRepository;
use Code4Romania\Cms\Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class UrlHelperTest extends TestCase
{
    use WithoutMiddleware;

    /** @test */
    public function itDetectsExternalUrls()
    {
        $this->assertTrue(UrlHelper::isExternal('http://example.com/path/'));

        $this->assertFalse(UrlHelper::isExternal(url('/absolute')));
        $this->assertFalse(UrlHelper::isExternal('/relative'));
    }

    /** @test */
    public function itDetectsAdminUrl()
    {
        $this->assertFalse(UrlHelper::isAdminUrl());
        $this->assertTrue(UrlHelper::isAdminUrl(
            route('admin.blocks.preview')
        ));
    }

    /** @test */
    public function itGeneratesLocaleUrlsForIndex()
    {
        $alternateLocaleUrls = $this
            ->getLocalesExceptCurrent()
            ->mapWithKeys(fn ($locale) => [$locale => url($locale)])
            ->toArray();

        $this->assertEquals($alternateLocaleUrls, UrlHelper::getAlternateLocaleUrls('front.pages.index'));
    }

    /** @test */
    public function itGeneratesLocaleUrlsForPublishedPage()
    {
        $locales = $this->getLocalesExceptCurrent();

        $attributes = collect([
            'languages' => $locales
                ->map(fn ($locale) => ['value' => $locale, 'published' => true]),

            'title' => $locales
                ->mapWithKeys(fn ($locale) => [$locale => $this->faker->word]),

            'slug' => $locales
                ->mapWithKeys(fn ($locale) => [$locale => $this->faker->slug]),
        ])->toArray();

        $page = app(PageRepository::class)->create($attributes);

        $alternateLocaleUrls = $locales
            ->mapWithKeys(fn ($locale) => [$locale => url($locale . '/' . $attributes['slug'][$locale])])
            ->toArray();

        $this->assertEquals($alternateLocaleUrls, UrlHelper::getAlternateLocaleUrls('front.pages.show', $page));
    }

    /** @test */
    public function itDoesntGenerateLocaleUrlsForUnpublishedTranslation()
    {
        $locales = $this->getAvailableLocales();

        $attributes = collect([
            'languages' => $locales
                ->map(fn ($locale) => ['value' => $locale, 'published' => $locale === app()->getLocale()]),

            'title' => $locales
                ->mapWithKeys(fn ($locale) => [$locale => $this->faker->word]),

            'slug' => $locales
                ->mapWithKeys(fn ($locale) => [$locale => $this->faker->slug]),
        ])->toArray();

        $page = app(PageRepository::class)->create($attributes);

        $this->assertEmpty(UrlHelper::getAlternateLocaleUrls('front.pages.show', $page));
    }

    /** @test */
    public function itDoesntGenerateLocaleUrlsForNullArgs()
    {
        $this->assertEmpty(UrlHelper::getAlternateLocaleUrls(null));
        $this->assertEmpty(UrlHelper::getAlternateLocaleUrls('front.pages.show', null));
    }
}
