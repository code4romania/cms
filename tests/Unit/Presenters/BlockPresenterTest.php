<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Tests\Presenters;

use A17\Twill\Models\Block;
use Code4Romania\Cms\Models\CityLab;
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
    public function it_presents_call_to_action_block()
    {
        $blockNone = $this->createBlock('callToAction', [
            'background_color' => null,
            'text_color' => null,
        ]);

        $blockText = $this->createBlock('callToAction', [
            'background_color' => null,
            'text_color' => '#FFF',
        ]);

        $blockBackground = $this->createBlock('callToAction', [
            'background_color' => '#FFF',
            'text_color' => null,
        ]);

        $blockBoth = $this->createBlock('callToAction', [
            'background_color' => '#FFF',
            'text_color' => '#FFF',
        ]);

        $this->assertEmpty($blockNone->present()->callToActionStyle);
        $this->assertEquals('color:#FFF;', $blockText->present()->callToActionStyle);
        $this->assertEquals('background-color:#FFF;', $blockBackground->present()->callToActionStyle);
        $this->assertEquals('background-color:#FFF;color:#FFF;', $blockBoth->present()->callToActionStyle);
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
            'https://www.youtube.com/embed/dQw4w9WgXcQ?feature=oembed',
            $blockEmbed->present()->embedCode
        );

        $this->assertNull($blockEmpty->present()->embedCode);
    }

    /** @test */
    public function it_presents_image_text_block()
    {
        $blockLeft = $this->createBlock('imageText', [
            'position' => 'left',
        ]);

        $blockRight = $this->createBlock('imageText', [
            'position' => 'right',
        ]);

        $blockTop = $this->createBlock('imageText', [
            'valign' => 'top',
        ]);

        $blockCenter = $this->createBlock('imageText', [
            'valign' => 'center',
        ]);

        $blockBottom = $this->createBlock('imageText', [
            'valign' => 'bottom',
        ]);

        $blockQuarter = $this->createBlock('imageText', [
            'width' => '1/4',
        ]);

        $blockThird = $this->createBlock('imageText', [
            'width' => '1/3',
        ]);

        $blockHalf = $this->createBlock('imageText', [
            'width' => '1/2',
        ]);

        $blockQuarterRight = $this->createBlock('imageText', [
            'width' => '1/4',
            'position' => 'right',
        ]);

        $blockThirdRight = $this->createBlock('imageText', [
            'width' => '1/3',
            'position' => 'right',
        ]);

        $blockHalfRight = $this->createBlock('imageText', [
            'width' => '1/2',
            'position' => 'right',
        ]);

        $this->assertEmpty($blockLeft->present()->imageTextContainerClass);
        $this->assertEmpty($blockRight->present()->imageTextContainerClass);
        $this->assertEquals('items-start', $blockTop->present()->imageTextContainerClass);
        $this->assertEquals('items-center', $blockCenter->present()->imageTextContainerClass);
        $this->assertEquals('items-end', $blockBottom->present()->imageTextContainerClass);
        $this->assertEquals('md:grid-cols-4', $blockQuarter->present()->imageTextContainerClass);
        $this->assertEquals('md:grid-cols-3', $blockThird->present()->imageTextContainerClass);
        $this->assertEquals('md:grid-cols-2', $blockHalf->present()->imageTextContainerClass);
        $this->assertEquals('md:grid-cols-4', $blockQuarterRight->present()->imageTextContainerClass);
        $this->assertEquals('md:grid-cols-3', $blockThirdRight->present()->imageTextContainerClass);
        $this->assertEquals('md:grid-cols-2', $blockHalfRight->present()->imageTextContainerClass);

        $this->assertEquals('col-span-1', $blockLeft->present()->imageTextImageClass);
        $this->assertEquals('col-span-1', $blockRight->present()->imageTextImageClass);
        $this->assertEquals('col-span-1', $blockTop->present()->imageTextImageClass);
        $this->assertEquals('col-span-1', $blockCenter->present()->imageTextImageClass);
        $this->assertEquals('col-span-1', $blockBottom->present()->imageTextImageClass);
        $this->assertEquals('col-span-1', $blockQuarter->present()->imageTextImageClass);
        $this->assertEquals('col-span-1', $blockThird->present()->imageTextImageClass);
        $this->assertEquals('col-span-1', $blockHalf->present()->imageTextImageClass);
        $this->assertEquals('col-span-1 md:col-start-4', $blockQuarterRight->present()->imageTextImageClass);
        $this->assertEquals('col-span-1 md:col-start-3', $blockThirdRight->present()->imageTextImageClass);
        $this->assertEquals('col-span-1 md:col-start-2', $blockHalfRight->present()->imageTextImageClass);

        $this->assertEquals('rich-text', $blockLeft->present()->imageTextContentClass);
        $this->assertEquals('rich-text', $blockRight->present()->imageTextContentClass);
        $this->assertEquals('rich-text', $blockTop->present()->imageTextContentClass);
        $this->assertEquals('rich-text', $blockCenter->present()->imageTextContentClass);
        $this->assertEquals('rich-text', $blockBottom->present()->imageTextContentClass);
        $this->assertEquals('rich-text md:col-span-3', $blockQuarter->present()->imageTextContentClass);
        $this->assertEquals('rich-text md:col-span-2', $blockThird->present()->imageTextContentClass);
        $this->assertEquals('rich-text md:col-span-1', $blockHalf->present()->imageTextContentClass);
        $this->assertEquals('rich-text md:col-span-3', $blockQuarterRight->present()->imageTextContentClass);
        $this->assertEquals('rich-text md:col-span-2', $blockThirdRight->present()->imageTextContentClass);
        $this->assertEquals('rich-text md:col-span-1', $blockHalfRight->present()->imageTextContentClass);
    }

    /** @test */
    public function it_presents_counter_block()
    {
        $blockPrimary = $this->createBlock('counter', [
            'background' => 'primary',
        ]);

        $blockWarning = $this->createBlock('counter', [
            'background' => 'warning',
        ]);

        $blockDanger = $this->createBlock('counter', [
            'background' => 'danger',
        ]);

        $blockGray = $this->createBlock('counter', [
            'background' => 'gray',
        ]);

        $blockNone = $this->createBlock('counter', [
            'background' => 'none',
        ]);

        $blockEmpty = $this->createBlock('counter');

        $blockOneColumn = $this->createBlock('counter', [
            'columns' => 1,
        ]);

        $blockTwoColumns = $this->createBlock('counter', [
            'columns' => 2,
        ]);

        $blockThreeColumns = $this->createBlock('counter', [
            'columns' => 3,
        ]);

        $this->assertEquals('bg-primary-700 text-white', $blockPrimary->present()->counterContainerClass);
        $this->assertEquals('bg-warning-400 text-black', $blockWarning->present()->counterContainerClass);
        $this->assertEquals('bg-danger-700 text-white', $blockDanger->present()->counterContainerClass);
        $this->assertEquals('bg-gray-800 text-white', $blockGray->present()->counterContainerClass);
        $this->assertEmpty($blockNone->present()->counterContainerClass);
        $this->assertEmpty($blockEmpty->present()->counterContainerClass);

        $this->assertEquals('grid-cols-1', $blockOneColumn->present()->counterColumnsClass);
        $this->assertEquals('grid-cols-2', $blockTwoColumns->present()->counterColumnsClass);
        $this->assertEquals('grid-cols-2 lg:grid-cols-3', $blockThreeColumns->present()->counterColumnsClass);
        $this->assertEmpty($blockEmpty->present()->counterColumnsClass);

        $this->assertEquals('text-white', $blockPrimary->present()->counterBadgeBackgroundClass);
        $this->assertEquals('text-black', $blockWarning->present()->counterBadgeBackgroundClass);
        $this->assertEquals('text-white', $blockDanger->present()->counterBadgeBackgroundClass);
        $this->assertEquals('text-white', $blockGray->present()->counterBadgeBackgroundClass);
        $this->assertEmpty($blockNone->present()->counterBadgeBackgroundClass);
        $this->assertEmpty($blockEmpty->present()->counterBadgeBackgroundClass);

        $this->assertEquals('text-primary-700', $blockPrimary->present()->counterBadgeTextClass);
        $this->assertEquals('text-warning-400', $blockWarning->present()->counterBadgeTextClass);
        $this->assertEquals('text-danger-700', $blockDanger->present()->counterBadgeTextClass);
        $this->assertEquals('text-gray-800', $blockGray->present()->counterBadgeTextClass);
        $this->assertEquals('text-white', $blockNone->present()->counterBadgeTextClass);
        $this->assertEquals('text-white', $blockEmpty->present()->counterBadgeTextClass);
    }

    /** @test */
    public function it_presents_partners_block()
    {
        $blockEmpty = $this->createBlock('partners');

        $blockTwoColumns = $this->createBlock('partners', [
            'columns' => 2,
        ]);

        $blockThreeColumns = $this->createBlock('partners', [
            'columns' => 3,
        ]);

        $blockFourColumns = $this->createBlock('partners', [
            'columns' => 4,
        ]);

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

        $this->assertEmpty($blockEmpty->present()->partnersColumnsClass);
        $this->assertEquals('sm:grid-cols-2', $blockTwoColumns->present()->partnersColumnsClass);
        $this->assertEquals('sm:grid-cols-2 lg:grid-cols-3', $blockThreeColumns->present()->partnersColumnsClass);
        $this->assertEquals('sm:grid-cols-2 lg:grid-cols-4', $blockFourColumns->present()->partnersColumnsClass);

        $this->assertEquals($partners, $blockWithBrowser->present()->partnersListPublished->pluck('id'));
    }

    /** @test */
    public function it_presents_people_block()
    {
        $blockEmpty = $this->createBlock('people');

        $blockTwoColumns = $this->createBlock('people', [
            'columns' => 2,
        ]);

        $blockThreeColumns = $this->createBlock('people', [
            'columns' => 3,
        ]);

        $blockFourColumns = $this->createBlock('people', [
            'columns' => 4,
        ]);

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

        $this->assertEmpty($blockEmpty->present()->peopleColumnsClass);
        $this->assertEquals('sm:grid-cols-2', $blockTwoColumns->present()->peopleColumnsClass);
        $this->assertEquals('sm:grid-cols-2 lg:grid-cols-3', $blockThreeColumns->present()->peopleColumnsClass);
        $this->assertEquals('sm:grid-cols-2 lg:grid-cols-4', $blockFourColumns->present()->peopleColumnsClass);

        $this->assertEquals($people, $blockWithBrowser->present()->peopleListPublished->pluck('id'));
    }
}
