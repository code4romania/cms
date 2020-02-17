<?php

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
        $this->assertEquals('md:grid-cols-2', $blockHalfRight->present()->imageTextContainerClass);

        $this->assertEquals('col-span-1', $blockLeft->present()->imageTextImageClass);
        $this->assertEquals('col-span-1', $blockRight->present()->imageTextImageClass);
        $this->assertEquals('col-span-1', $blockTop->present()->imageTextImageClass);
        $this->assertEquals('col-span-1', $blockCenter->present()->imageTextImageClass);
        $this->assertEquals('col-span-1', $blockBottom->present()->imageTextImageClass);
        $this->assertEquals('col-span-1', $blockQuarter->present()->imageTextImageClass);
        $this->assertEquals('col-span-1', $blockThird->present()->imageTextImageClass);
        $this->assertEquals('col-span-1', $blockHalf->present()->imageTextImageClass);
        $this->assertEquals('col-span-1 md:col-start-2', $blockHalfRight->present()->imageTextImageClass);

        $this->assertEmpty($blockLeft->present()->imageTextContentClass);
        $this->assertEmpty($blockRight->present()->imageTextContentClass);
        $this->assertEmpty($blockTop->present()->imageTextContentClass);
        $this->assertEmpty($blockCenter->present()->imageTextContentClass);
        $this->assertEmpty($blockBottom->present()->imageTextContentClass);
        $this->assertEquals('md:col-span-3', $blockQuarter->present()->imageTextContentClass);
        $this->assertEquals('md:col-span-2', $blockThird->present()->imageTextContentClass);
        $this->assertEquals('md:col-span-1', $blockHalf->present()->imageTextContentClass);
        $this->assertEquals('md:col-span-1', $blockHalfRight->present()->imageTextContentClass);
    }
}
