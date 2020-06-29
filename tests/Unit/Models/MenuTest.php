<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Tests\Models;

use A17\Twill\Models\Block;
use Code4Romania\Cms\Models\Category;
use Code4Romania\Cms\Models\Menu;
use Code4Romania\Cms\Models\Page;
use Code4Romania\Cms\Tests\TestCase;

class MenuTest extends TestCase
{
    private function addMenuItem(Menu $menu, string $type, string $target, ?int $parent_id = null): Block
    {
        $locales = $this->getAvailableLocales();

        if ($menu->blocks->count()) {
            $position = $menu->blocks->last()->position + 1;
        } else {
            $position = 1;
        }

        $item = factory(Block::class)->create([
            'parent_id' => $parent_id,
            'child_key' => !is_null($parent_id) ? 'menuItem' : null,

            'position' => $position,
            'type'     => 'menuItem',
            'content'  => [
                'type'   => $type,
                'target' => $target,

                'label'  => $locales
                    ->mapWithKeys(fn ($locale) => [$locale => $this->faker->word]),
            ],
        ]);

        $menu->blocks()->save($item);

        return $item;
    }

    /** @test */
    public function test_it_returns_an_empty_array_for_an_unknown_menu_location()
    {
        $this->assertEmpty(Menu::getLocation('doesNotExist'));
    }


    /** @test */
    public function it_returns_an_array_for_a_known_menu_location()
    {
        $menu = factory(Menu::class)
            ->states('published', 'header')
            ->create();

        $page = factory(Page::class)
            ->states('published')
            ->create();

        $category = factory(Category::class)
            ->create();

        $externalMenuItem = $this->addMenuItem($menu, 'external', $this->faker->url);
        $subMenuItem = $this->addMenuItem($menu, 'external', $this->faker->url, $externalMenuItem->id);
        $pageMenuItem = $this->addMenuItem($menu, 'page', (string) $page->id);
        $categoryMenuItem = $this->addMenuItem($menu, 'category', (string) $category->id);
        $invalidMenuItem = $this->addMenuItem($menu, 'doesNotExist', '#');

        $expectedTree = [
            [
                'id'        => $externalMenuItem->id,
                'parent_id' => $externalMenuItem->parent_id,
                'type'      => 'external',
                'label'     => $externalMenuItem->translatedInput('label'),
                'url'       => $externalMenuItem->input('target'),
                'children'  => [
                    [
                        'id'        => $subMenuItem->id,
                        'parent_id' => $subMenuItem->parent_id,
                        'type'      => 'external',
                        'label'     => $subMenuItem->translatedInput('label'),
                        'url'       => $subMenuItem->input('target'),
                        'children'  => [],
                    ],
                ],
            ],
            [
                'id'        => $pageMenuItem->id,
                'parent_id' => $pageMenuItem->parent_id,
                'type'      => 'page',
                'label'     => $pageMenuItem->translatedInput('label'),
                'url'       => route('front.pages.show', $page->slug),
                'children'  => [],
            ],
            [
                'id'        => $categoryMenuItem->id,
                'parent_id' => $categoryMenuItem->parent_id,
                'type'      => 'category',
                'label'     => $categoryMenuItem->translatedInput('label'),
                'url'       => route('front.categories.show', $category->slug),
                'children'  => [],
            ],
            [
                'id'        => $invalidMenuItem->id,
                'parent_id' => $invalidMenuItem->parent_id,
                'type'      => 'doesNotExist',
                'label'     => $invalidMenuItem->translatedInput('label'),
                'url'       => null,
                'children'  => [],
            ],
        ];

        $this->assertEquals($expectedTree, Menu::getLocation('header'));
    }
}
