<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Tests\Http\Controllers\Front;

use A17\Twill\Models\User;
use Code4Romania\Cms\Models\CityLab;
use Code4Romania\Cms\Tests\TestCase;

class CityLabControllerTest extends TestCase
{
    /** @test */
    public function it_fetches_the_city_labs_list()
    {
        $this->withoutExceptionHandling();
        // dd(config('blade-icons'));
        $cityLabs = factory(CityLab::class, 3)
            ->state('published')
            ->create();

        $this->get(route('front.cityLabs.index'))
            ->assertResponseOk()
            ->see($cityLabs->random()->name);
    }

    /** @test */
    public function it_fetches_published_city_labs_for_guests()
    {
        $cityLab = factory(CityLab::class)
            ->state('published')
            ->create();

        $this->get(route('front.cityLabs.show', ['slug' => $cityLab->slug]))
            ->assertResponseOk()
            ->see($cityLab->name);
    }

    /** @test */
    public function it_returns_an_error_for_unpublished_city_labs()
    {
        $cityLab = factory(CityLab::class)
            ->create();

        $this->get(route('front.cityLabs.show', ['slug' => $cityLab->slug]))
            ->assertResponseStatus(404);
    }

    /** @test */
    public function it_fetches_city_lab_previews_for_administrators()
    {
        $admin = factory(User::class)->states('admin', 'active')->create();
        $cityLab = factory(CityLab::class)->create();

        $this->actingAs($admin, 'twill_users')
            ->visit(route('front.cityLabs.preview', ['slug' => $cityLab->slug]))
            ->assertResponseOk();
    }

    // /** @test */
    public function it_returns_an_error_for_city_lab_previews_for_guests()
    {
        $cityLab = factory(CityLab::class)->create();

        $this->get(route('front.cityLabs.preview', ['slug' => $cityLab->slug]))
            ->assertRedirectedToRoute('admin.login.form');
    }
}
