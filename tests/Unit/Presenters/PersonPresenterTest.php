<?php

namespace Code4Romania\Cms\Tests\Presenters;

use Code4Romania\Cms\Models\CityLab;
use Code4Romania\Cms\Models\Person;
use Code4Romania\Cms\Tests\TestCase;

class PersonPresenterTest extends TestCase
{
    /** @test */
    public function itPresentsCityLabName()
    {
        $personWithCity = factory(Person::class)->create();
        $personWithoutCity = factory(Person::class)->create();
        $cityLab = factory(CityLab::class)->create();

        $cityLab->people()->saveMany([
            $personWithCity
        ]);

        $this->assertEquals('–', $personWithoutCity->presentAdmin()->cityLab());
        $this->assertEquals($cityLab->name, $personWithCity->presentAdmin()->cityLab());
    }
}
