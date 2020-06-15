<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Tests\Models;

use Code4Romania\Cms\Models\Partner;
use Code4Romania\Cms\Tests\TestCase;

class PartnerTest extends TestCase
{
    /** @test */
    public function it_fetches_the_browser_title()
    {
        $partner = factory(Partner::class)->create();

        $this->assertEquals($partner->name, $partner->title_in_browser);
    }
}
