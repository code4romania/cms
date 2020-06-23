<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Tests\Presenters;

use A17\Twill\Models\Block;
use Code4Romania\Cms\Models\CityLab;
use Code4Romania\Cms\Models\Form;
use Code4Romania\Cms\Models\Partner;
use Code4Romania\Cms\Models\Person;
use Code4Romania\Cms\Tests\TestCase;

class BlockPresenterTest extends TestCase
{
    protected function createBlock(string $type, array $content = []): Block
    {
        return factory(Block::class)->make([
            'type'    => $type,
            'content' => $content,
        ]);
    }

    /** @test */
    public function it_presents_model_attribute_if_presenter_doesnt_have_method()
    {
        $block = $this->createBlock('fallbackTest');

        $this->assertEquals($block->type, $block->present()->type);
    }

    /** @test */
    public function it_presents_city_labs_block()
    {
        $cityLabs = factory(CityLab::class, 10)
            ->state('published')
            ->create()
            ->shuffle()
            ->pluck('id');

        $blockWithBrowser = $this->createBlock('cityLabs', [
            'browsers' => [
                'cityLabs' => $cityLabs,
            ],
        ]);

        $this->assertEquals($cityLabs, $blockWithBrowser->present()->cityLabsListPublished->pluck('id'));
    }

    /** @test */
    public function it_presents_embed_block()
    {
        $blockEmbed = $this->createBlock('embed', [
            'url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
        ]);

        $blockEmpty = $this->createBlock('embed', []);

        $this->assertStringContainsString(
            'https://www.youtube.com/embed/dQw4w9WgXcQ',
            $blockEmbed->present()->embedCode
        );
        $this->assertEquals('16/9', $blockEmbed->present()->embedAspectRatio);

        $this->assertNull($blockEmpty->present()->embedCode);
        $this->assertNull($blockEmpty->present()->embedAspectRatio);
    }


    /** @test */
    public function it_presents_form_block()
    {
        $form = factory(Form::class)
            ->state('published')
            ->create();

        $blockWithBrowser = $this->createBlock('form', [
            'form' => $form->id,
        ]);

        $this->assertEquals($form->id, $blockWithBrowser->present()->formPublished->id);
    }

    /** @test */
    public function it_presents_partners_block()
    {
        $partners = factory(Partner::class, 10)
            ->state('published')
            ->create()
            ->shuffle()
            ->pluck('id');

        $blockWithBrowser = $this->createBlock('partners', [
            'browsers' => [
                'partners' => $partners,
            ],
        ]);

        $this->assertEquals($partners, $blockWithBrowser->present()->partnersListPublished->pluck('id'));
    }

    /** @test */
    public function it_presents_people_block()
    {
        $people = factory(Person::class, 10)
            ->state('published')
            ->create()
            ->shuffle()
            ->pluck('id');

        $blockWithBrowser = $this->createBlock('people', [
            'browsers' => [
                'people' => $people,
            ],
        ]);

        $this->assertEquals($people, $blockWithBrowser->present()->peopleListPublished->pluck('id'));
    }
}
