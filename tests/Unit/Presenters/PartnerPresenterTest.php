<?php

namespace Code4Romania\Cms\Tests\Presenters;

use A17\Twill\Models\Media;
use Code4Romania\Cms\Models\Partner;
use Code4Romania\Cms\Tests\TestCase;

class PartnerPresenterTest extends TestCase
{
    /** @test */
    public function itPresentsImageSrc()
    {
        $person = factory(Partner::class)->create();
        $image = factory(Media::class)->create([
            'width'  => 200,
            'height' => 200,
        ]);

        $this->assertEquals($person->placeholder_avatar, $person->present()->imageSrc);

        $person->medias()->save($image, [
            'crop_x'    => 0,
            'crop_y'    => 0,
            'crop_w'    => $image->width,
            'crop_h'    => $image->height,
            'role'      => 'logo',
            'crop'      => 'default',
            'ratio'     => 'default',
            'lqip_data' => null,
            'metadatas' => json_encode([
                'caption' => null,
                'altText' => null,
                'video'   => null,
            ]),
        ]);

        $person->load('medias');

        $this->assertStringContainsString(url("/img/{$image->uuid}"), $person->present()->imageSrc);
    }
}
