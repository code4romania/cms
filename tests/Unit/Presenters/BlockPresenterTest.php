<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Tests\Presenters;

use A17\Twill\Models\Block;
use Code4Romania\Cms\Tests\TestCase;

class BlockPresenterTest extends TestCase
{
    protected function createBlockWithContent(string $type, array $content = []): Block
    {
        return Block::create([
            'type' => $type,
            'position' => $this->faker->randomDigitNotNull,
            'content' => $content,
        ]);
    }

    /** @test */
    public function itPresentsModelAttributeIfPresenterDoesntHaveMethod()
    {
        $block = $this->createBlockWithContent('fallbackTest');

        $this->assertEquals($block->type, $block->present()->type);
    }

    /** @test */
    public function itPresentsCallToActionBlock()
    {
        $blockNone = $this->createBlockWithContent('callToAction', [
            'background_color' => null,
            'text_color' => null,
        ]);

        $blockText = $this->createBlockWithContent('callToAction', [
            'background_color' => null,
            'text_color' => '#FFF',
        ]);

        $blockBackground = $this->createBlockWithContent('callToAction', [
            'background_color' => '#FFF',
            'text_color' => null,
        ]);

        $blockBoth = $this->createBlockWithContent('callToAction', [
            'background_color' => '#FFF',
            'text_color' => '#FFF',
        ]);

        $this->assertEmpty($blockNone->present()->callToActionStyle);
        $this->assertEquals('color:#FFF;', $blockText->present()->callToActionStyle);
        $this->assertEquals('background-color:#FFF;', $blockBackground->present()->callToActionStyle);
        $this->assertEquals('background-color:#FFF;color:#FFF;', $blockBoth->present()->callToActionStyle);
    }

    /** @test */
    public function itPresentsEmbedBlock()
    {
        $blockEmbed = $this->createBlockWithContent('embed', [
            'url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
        ]);

        $blockEmpty = $this->createBlockWithContent('embed', []);

        $this->assertStringContainsString(
            'https://www.youtube.com/embed/dQw4w9WgXcQ?feature=oembed',
            $blockEmbed->present()->embedCode
        );

        $this->assertNull($blockEmpty->present()->embedCode);
    }

    /** @test */
    public function itPresentsImageTextBlock()
    {
        $blockLeft = $this->createBlockWithContent('imageText', [
            'position' => 'left',
        ]);

        $blockRight = $this->createBlockWithContent('imageText', [
            'position' => 'right',
        ]);

        $blockTop = $this->createBlockWithContent('imageText', [
            'valign' => 'top',
        ]);

        $blockCenter = $this->createBlockWithContent('imageText', [
            'valign' => 'center',
        ]);

        $blockBottom = $this->createBlockWithContent('imageText', [
            'valign' => 'bottom',
        ]);

        $blockQuarter = $this->createBlockWithContent('imageText', [
            'width' => '1/4',
        ]);

        $blockThird = $this->createBlockWithContent('imageText', [
            'width' => '1/3',
        ]);

        $blockHalf = $this->createBlockWithContent('imageText', [
            'width' => '1/2',
        ]);

        $blockQuarterRight = $this->createBlockWithContent('imageText', [
            'width' => '1/4',
            'position' => 'right',
        ]);

        $blockThirdRight = $this->createBlockWithContent('imageText', [
            'width' => '1/3',
            'position' => 'right',
        ]);

        $blockHalfRight = $this->createBlockWithContent('imageText', [
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
    public function itPresentsCounterBlock()
    {
        $blockPrimary = $this->createBlockWithContent('counter', [
            'background' => 'primary',
        ]);

        $blockSecondary = $this->createBlockWithContent('counter', [
            'background' => 'secondary',
        ]);

        $blockDanger = $this->createBlockWithContent('counter', [
            'background' => 'danger',
        ]);

        $blockGray = $this->createBlockWithContent('counter', [
            'background' => 'gray',
        ]);

        $blockNone = $this->createBlockWithContent('counter', [
            'background' => 'none',
        ]);

        $blockEmpty = $this->createBlockWithContent('counter');

        $blockOneColumn = $this->createBlockWithContent('counter', [
            'columns' => 1,
        ]);

        $blockTwoColumns = $this->createBlockWithContent('counter', [
            'columns' => 2,
        ]);

        $blockThreeColumns = $this->createBlockWithContent('counter', [
            'columns' => 3,
        ]);

        $this->assertEquals('bg-primary-700 text-white', $blockPrimary->present()->counterContainerClass);
        $this->assertEquals('bg-secondary-400 text-black', $blockSecondary->present()->counterContainerClass);
        $this->assertEquals('bg-danger-700 text-white', $blockDanger->present()->counterContainerClass);
        $this->assertEquals('bg-gray-800 text-white', $blockGray->present()->counterContainerClass);
        $this->assertEmpty($blockNone->present()->counterContainerClass);
        $this->assertEmpty($blockEmpty->present()->counterContainerClass);

        $this->assertEquals('grid-cols-1', $blockOneColumn->present()->counterColumnsClass);
        $this->assertEquals('grid-cols-2', $blockTwoColumns->present()->counterColumnsClass);
        $this->assertEquals('grid-cols-2 lg:grid-cols-3', $blockThreeColumns->present()->counterColumnsClass);
        $this->assertEmpty($blockEmpty->present()->counterColumnsClass);

        $this->assertEquals('text-white', $blockPrimary->present()->counterBadgeBackgroundClass);
        $this->assertEquals('text-black', $blockSecondary->present()->counterBadgeBackgroundClass);
        $this->assertEquals('text-white', $blockDanger->present()->counterBadgeBackgroundClass);
        $this->assertEquals('text-white', $blockGray->present()->counterBadgeBackgroundClass);
        $this->assertEmpty($blockNone->present()->counterBadgeBackgroundClass);
        $this->assertEmpty($blockEmpty->present()->counterBadgeBackgroundClass);

        $this->assertEquals('text-primary-700', $blockPrimary->present()->counterBadgeTextClass);
        $this->assertEquals('text-secondary-400', $blockSecondary->present()->counterBadgeTextClass);
        $this->assertEquals('text-danger-700', $blockDanger->present()->counterBadgeTextClass);
        $this->assertEquals('text-gray-800', $blockGray->present()->counterBadgeTextClass);
        $this->assertEquals('text-white', $blockNone->present()->counterBadgeTextClass);
        $this->assertEquals('text-white', $blockEmpty->present()->counterBadgeTextClass);
    }
}
