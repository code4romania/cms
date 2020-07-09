<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Tests\Presenters;

use A17\Twill\Models\Media;
use Code4Romania\Cms\Models\Partner;
use Code4Romania\Cms\Tests\TestCase;

class PartnerPresenterTest extends TestCase
{
    /** @test */
    public function it_presents_image_src()
    {
        $partner = factory(Partner::class)->create();
        $image = factory(Media::class)->create([
            'width'  => 200,
            'height' => 200,
        ]);

        $partner->medias()->save($image, [
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

        $partner->load('medias');

        $this->assertStringContainsString("/img/{$image->uuid}", $partner->present()->imageSrc);
    }
}
