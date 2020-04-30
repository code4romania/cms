<?php

namespace Code4Romania\Cms\Tests\Http\Controllers\Front;

use A17\Twill\Models\User;
use Code4Romania\Cms\Helpers\SettingsHelper;
use Code4Romania\Cms\Models\Page;
use Code4Romania\Cms\Tests\TestCase;

class PageControllerTest extends TestCase
{
    /** @test */
    public function itReturnsAnErrorWhenFrontPageNotSet()
    {
        $this->get(route('front.pages.index'))
            ->assertResponseStatus(404);
    }

    /** @test */
    public function itFetchesTheFrontPage()
    {
        $page = factory(Page::class)
            ->state('published')
            ->create();

        SettingsHelper::set(['frontPage' => $page->id], 'site');

        $this->get(route('front.pages.index'))
            ->assertResponseOk();
    }

    /** @test */
    public function itFetchesPublishedPagesForGuests()
    {
        $page = factory(Page::class)
            ->state('published')
            ->create();

        $this->get(route('front.pages.show', ['slug' => $page->slug]))
            ->assertResponseOk();
    }

    /** @test */
    public function itReturnsAnErrorForUnpublishedPages()
    {
        $page = factory(Page::class)
            ->create();

        $this->get(route('front.pages.show', ['slug' => $page->slug]))
            ->assertResponseStatus(404);
    }

    /** @test */
    public function itFetchesPagePreviewsForAdministrators()
    {
        $admin = factory(User::class)->states('admin', 'active')->create();
        $page = factory(Page::class)->create();

        $this->actingAs($admin, 'twill_users')
            ->visit(route('front.pages.preview', ['slug' => $page->slug]))
            ->assertResponseOk();
    }

    /** @test */
    public function itReturnsAnErrorForPagePreviewsForGuests()
    {
        $this->withoutExceptionHandling();

        $page = factory(Page::class)->create();

        $this->get(route('front.pages.preview', ['slug' => $page->slug]))
            ->assertRedirectedToRoute('admin.login.form');
    }
}
