<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Tests\Models;

use Code4Romania\Cms\Models\Person;
use Code4Romania\Cms\Tests\TestCase;
use Illuminate\Support\Facades\Storage;

class PersonTest extends TestCase
{
    /** @test */
    public function it_generates_placeholder_avatar()
    {
        // Cleanup to ensure we're actually testing placeholder avatar creation
        Storage::disk('public')->deleteDirectory('avatars');

        $person = factory(Person::class)->create();

        $this->assertEquals($person->placeholder_avatar, $person->present()->imageSrc);
    }

    /** @test */
    public function it_fetches_the_browser_title()
    {
        $person = factory(Person::class)->create();

        $this->assertEquals($person->name, $person->title_in_browser);
    }
}
