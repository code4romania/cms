<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Tests\Http\Controllers\Front;

use A17\Twill\Models\User;
use Code4Romania\Cms\Helpers\SettingsHelper;
use Code4Romania\Cms\Models\CityLab;
use Code4Romania\Cms\Tests\TestCase;

class CityLabControllerTest extends TestCase
{
    /** @test */
    public function itFetchesTheCityLabsList()
    {
        $cityLabs = factory(CityLab::class, 3)
            ->state('published')
            ->create();

        $this->get(route('front.cityLabs.index'))
            ->assertResponseOk()
            ->see($cityLabs->random()->name);
    }

    /** @test */
    public function itFetchesPublishedCityLabsForGuests()
    {
        $cityLab = factory(CityLab::class)
            ->state('published')
            ->create();

        $this->get(route('front.cityLabs.show', ['slug' => $cityLab->slug]))
            ->assertResponseOk()
            ->see($cityLab->name);
    }

    /** @test */
    public function itReturnsAnErrorForUnpublishedCityLabs()
    {
        $cityLab = factory(CityLab::class)
            ->create();

        $this->get(route('front.cityLabs.show', ['slug' => $cityLab->slug]))
            ->assertResponseStatus(404);
    }

    /** @test */
    public function itFetchesCityLabPreviewsForAdministrators()
    {
        $admin = factory(User::class)->states('admin', 'active')->create();
        $cityLab = factory(CityLab::class)->create();

        $this->actingAs($admin, 'twill_users')
            ->visit(route('front.cityLabs.preview', ['slug' => $cityLab->slug]))
            ->assertResponseOk();
    }

    // /** @test */
    public function itReturnsAnErrorForCityLabPreviewsForGuests()
    {
        $cityLab = factory(CityLab::class)->create();

        $this->get(route('front.cityLabs.preview', ['slug' => $cityLab->slug]))
            ->assertRedirectedToRoute('admin.login.form');
    }
}
