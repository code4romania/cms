<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Tests\Http\Controllers\Front;

use A17\Twill\Models\User;
use Code4Romania\Cms\Helpers\SettingsHelper;
use Code4Romania\Cms\Models\Page;
use Code4Romania\Cms\Tests\TestCase;

class PageControllerTest extends TestCase
{
    /** @test */
    public function it_returns_an_error_when_front_page_not_set()
    {
        $this->get(route('front.pages.index'))
            ->assertResponseStatus(404);
    }

    /** @test */
    public function it_fetches_the_front_page()
    {
        $page = factory(Page::class)
            ->state('published')
            ->create();

        SettingsHelper::set(['frontPage' => $page->id], 'site');

        $this->get(route('front.pages.index'))
            ->assertResponseOk();
    }

    /** @test */
    public function it_fetches_published_pages_for_guests()
    {
        $page = factory(Page::class)
            ->state('published')
            ->create();

        $this->get(route('front.pages.show', ['slug' => $page->slug]))
            ->assertResponseOk();
    }

    /** @test */
    public function it_returns_an_error_for_unpublished_pages()
    {
        $page = factory(Page::class)
            ->create();

        $this->get(route('front.pages.show', ['slug' => $page->slug]))
            ->assertResponseStatus(404);
    }

    /** @test */
    public function it_fetches_page_previews_for_administrators()
    {
        $admin = factory(User::class)->states('admin', 'active')->create();
        $page = factory(Page::class)->create();

        $this->actingAs($admin, 'twill_users')
            ->get(route('front.pages.preview', ['slug' => $page->slug]))
            ->assertResponseOk();
    }

    /** @test */
    public function it_returns_an_error_for_page_previews_for_guests()
    {
        $page = factory(Page::class)->create();

        $this->get(route('front.pages.preview', ['slug' => $page->slug]))
            ->assertRedirectedToRoute('admin.login.form');
    }
}
