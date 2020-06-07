<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Tests\Helpers;

use Artesaos\SEOTools\Facades\SEOMeta;
use Code4Romania\Cms\Tests\TestCase;
use Code4Romania\Cms\Traits\WithSeoTags;

class WithSeoTagsTest extends TestCase
{
    use WithSeoTags;

    /** @test */
    public function it_generates_the_title()
    {
        $title = $this->faker->sentence;
        $separator = config('seotools.meta.defaults.separator');
        $default = config('seotools.meta.defaults.title');

        $this->setTitle($title);

        if (config('seotools.meta.defaults.titleBefore')) {
            $this->assertEquals($default . $separator . $title, SEOMeta::getTitle());
        } else {
            $this->assertEquals($title . $separator . $default, SEOMeta::getTitle());
        }

        $this->currentPage = 2;
        $this->setTitle($title);
        $page = ' - ' . __('pagination.page', ['page' => $this->currentPage]);

        if (config('seotools.meta.defaults.titleBefore')) {
            $this->assertEquals($default . $separator . $title . $page, SEOMeta::getTitle());
        } else {
            $this->assertEquals($title . $page .  $separator . $default, SEOMeta::getTitle());
        }
    }

    /** @test */
    public function it_returns_the_default_title_when_empty()
    {
        $title = '';
        $default = config('seotools.meta.defaults.title');

        $this->setTitle($title);

        $this->assertEquals($default, SEOMeta::getTitle());

        $this->currentPage = 2;
        $this->setTitle($title);

        $this->assertEquals($default, SEOMeta::getTitle());
    }

    /** @test */
    public function it_generates_the_description_when_provided()
    {
        $description = $this->faker->sentence;

        $this->setDescription($description);

        $this->assertEquals($description, SEOMeta::getDescription());
    }

    /** @test */
    public function it_generates_the_default_description_when_empty()
    {
        $description = '';
        $default = config('seotools.meta.defaults.description');
        $this->setDescription($description);

        $this->assertEquals($default, SEOMeta::getDescription());
    }

    /** @test */
    public function it_generates_canonical_urls()
    {
        $this->setCanonical('');
        $this->assertFalse(SEOMeta::getCanonical());

        $this->setCanonical('front.pages.index');
        $this->assertEquals(route('front.pages.index'), SEOMeta::getCanonical());

        $this->setCanonical('front.pages.show', 'slug', 'test');
        $this->assertEquals(route('front.pages.show', ['slug' => 'test']), SEOMeta::getCanonical());
    }

    /** @test */
    public function it_parses_arguments()
    {
        $defaultTitle = config('seotools.meta.defaults.title');
        $defaultDescription = config('seotools.meta.defaults.description');

        $this->seo();

        $this->assertEquals($defaultTitle, SEOMeta::getTitle());
        $this->assertEquals($defaultDescription, SEOMeta::getDescription());
        $this->assertFalse(SEOMeta::getCanonical());
    }
}
