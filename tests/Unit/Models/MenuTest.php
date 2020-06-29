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
    /** @var Menu */
    protected $menu;

    private function addItem(string $type, ?string $target = null, ?int $parent_id = null, bool $newtab = false): Block
    {
        $locales = $this->getAvailableLocales();

        if ($this->menu->blocks->count()) {
            $position = $this->menu->blocks->last()->position + 1;
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
                'newtab' => $newtab,

                'label'  => $locales
                    ->mapWithKeys(fn ($locale) => [$locale => $this->faker->word]),
            ],
        ]);

        $this->menu->blocks()->save($item);

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
        $this->menu = factory(Menu::class)
            ->states('published', 'header')
            ->create();

        $page = factory(Page::class)
            ->states('published')
            ->create();

        $category = factory(Category::class)
            ->create();

        $externalMenuItem = $this->addItem('external', $this->faker->url);
        $subMenuItem = $this->addItem('external', $this->faker->url, $externalMenuItem->id, true);
        $pageMenuItem = $this->addItem('page', (string) $page->id);
        $blogMenuItem = $this->addItem('blog');
        $categoryMenuItem = $this->addItem('category', (string) $category->id, $blogMenuItem->id);
        $invalidMenuItem = $this->addItem('doesNotExist', '#');

        $expectedTree = [
            [
                'id'        => $externalMenuItem->id,
                'parent_id' => $externalMenuItem->parent_id,
                'type'      => 'external',
                'label'     => $externalMenuItem->translatedInput('label'),
                'newtab'    => false,
                'url'       => $externalMenuItem->input('target'),
                'children'  => [
                    [
                        'id'        => $subMenuItem->id,
                        'parent_id' => $subMenuItem->parent_id,
                        'type'      => 'external',
                        'label'     => $subMenuItem->translatedInput('label'),
                        'newtab'    => true,
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
                'newtab'    => false,
                'url'       => route('front.pages.show', $page->slug),
                'children'  => [],
            ],
            [
                'id'        => $blogMenuItem->id,
                'parent_id' => $blogMenuItem->parent_id,
                'type'      => 'blog',
                'label'     => $blogMenuItem->translatedInput('label'),
                'newtab'    => false,
                'url'       => route('front.posts.index'),
                'children'  => [
                    [
                        'id'        => $categoryMenuItem->id,
                        'parent_id' => $categoryMenuItem->parent_id,
                        'type'      => 'category',
                        'label'     => $categoryMenuItem->translatedInput('label'),
                        'newtab'    => false,
                        'url'       => route('front.categories.show', $category->slug),
                        'children'  => [],
                    ],
                ],
            ],
            [
                'id'        => $invalidMenuItem->id,
                'parent_id' => $invalidMenuItem->parent_id,
                'type'      => 'doesNotExist',
                'label'     => $invalidMenuItem->translatedInput('label'),
                'newtab'    => false,
                'url'       => null,
                'children'  => [],
            ],
        ];

        $this->assertEquals($expectedTree, Menu::getLocation('header'));
    }
}
