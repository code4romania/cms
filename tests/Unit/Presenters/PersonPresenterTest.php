<?php

namespace Code4Romania\Cms\Tests\Presenters;

use A17\Twill\Models\Media;
use Code4Romania\Cms\Models\CityLab;
use Code4Romania\Cms\Models\Person;
use Code4Romania\Cms\Tests\TestCase;
use Illuminate\Support\Facades\Artisan;

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

        $this->assertEquals('–', $personWithoutCity->presentAdmin()->cityLab);
        $this->assertEquals($cityLab->name, $personWithCity->presentAdmin()->cityLab);
    }

    /** @test */
    public function itPresentsImageSrcAndLqip()
    {
        $person = factory(Person::class)->create();
        $image = factory(Media::class)->create([
            'width'  => 96,
            'height' => 96,
        ]);

        $this->assertEquals($person->placeholder_avatar, $person->present()->imageSrc);
        $this->assertNull($person->present()->imageLqip);

        $lqipData = 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7s';
        $person->medias()->save($image, [
            'crop_x'    => 0,
            'crop_y'    => 0,
            'crop_w'    => $image->width,
            'crop_h'    => $image->height,
            'role'      => 'image',
            'crop'      => 'default',
            'ratio'     => 'default',
            'lqip_data' => $lqipData,
            'metadatas' => json_encode([
                'caption' => null,
                'altText' => null,
                'video'   => null,
            ]),
        ]);

        $person->load('medias');

        $this->assertStringContainsString(url("/img/{$image->uuid}"), $person->present()->imageSrc);
        $this->assertEquals($lqipData, $person->present()->imageLqip);
    }
}
