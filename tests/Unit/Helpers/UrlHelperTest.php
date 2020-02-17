<?php

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
    /*public function itGeneratesAlternateLocaleUrls()
    {
        $locales = collect(config('translatable.locales', []));

        $pageAttributes = [
            'active' => $locales
                ->mapWithKeys(fn ($locale) => [$locale => true])
                ->toArray(),
            'title' => $locales
                ->mapWithKeys(fn ($locale) => [$locale => $this->faker->sentence])
                ->toArray(),
            'slug' => $locales
                ->mapWithKeys(fn ($locale) => [$locale => $this->faker->slug])
                ->toArray(),
        ];

        $page = app(PageRepository::class)->create($pageAttributes);
    }*/
}
