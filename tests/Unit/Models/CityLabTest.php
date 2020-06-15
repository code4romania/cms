<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Tests\Models;

use Code4Romania\Cms\Models\CityLab;
use Code4Romania\Cms\Tests\TestCase;

class CityLabTest extends TestCase
{
    /** @test */
    public function it_fetches_the_browser_title()
    {
        $cityLab = factory(CityLab::class)->create();

        $this->assertEquals($cityLab->name, $cityLab->title_in_browser);
    }
}
