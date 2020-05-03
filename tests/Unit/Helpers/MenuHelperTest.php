<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Tests\Helpers;

use A17\Twill\Models\Block;
use Code4Romania\Cms\Helpers\MenuHelper;
use Code4Romania\Cms\Models\Menu;
use Code4Romania\Cms\Models\Page;
use Code4Romania\Cms\Repositories\MenuRepository;
use Code4Romania\Cms\Tests\TestCase;

class MenuHelperTest extends TestCase
{

    protected function createMenu(string $location)
    {
        $locales = $this->getAvailableLocales();

        $attributes = collect([
            'published' => true,
            'languages' => $locales
                ->map(fn ($locale) => ['value' => $locale, 'active' => true, 'published' => true]),

            'location' => $location,
        ])->toArray();


        return [
            'attributes' => $attributes,
            'model'      => app(MenuRepository::class)->create($attributes),
        ];
    }

    protected function addMenuItem(Menu $menu, string $type, string $target, ?int $parent_id = null): Block
    {
        $locales = $this->getAvailableLocales();

        if ($menu->blocks->count()) {
            $position = $menu->blocks->last()->position + 1;
        } else {
            $position = 1;
        }

        $attributes = collect([
            'parent_id' => $parent_id,
            'child_key' => !is_null($parent_id) ? 'menuItem' : null,

            'position' => $position,
            'type'     => 'menuItem',
            'target'   => $target,
            'content'  => [
                'type'   => $type,
                'target' => $target,

                'label'  => $locales
                    ->mapWithKeys(fn ($locale) => [$locale => $this->faker->word]),
            ],
        ]);

        $attributes = $attributes->toArray();

        $item = Block::create($attributes);

        $menu->blocks()->save($item);

        return $item;
    }

    /** @test */
    public function itReturnsAnEmptyArrayForAnUnknownMenuLocation()
    {
        $this->assertEmpty(MenuHelper::getItemsTree('doesNotExist'));
    }

    /** @test */
    public function itReturnsAnArrayForAKnownMenuLocation()
    {
        $menu = $this->createMenu('header')['model'];
        $page = factory(Page::class)
            ->states('published')
            ->create();

        $externalMenuItem = $this->addMenuItem($menu, 'external', $this->faker->url);
        $subMenuItem = $this->addMenuItem($menu, 'external', $this->faker->url, $externalMenuItem->id);
        $pageMenuItem = $this->addMenuItem($menu, 'page', (string) $page->id);
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
                'id'        => $invalidMenuItem->id,
                'parent_id' => $invalidMenuItem->parent_id,
                'type'      => 'doesNotExist',
                'label'     => $invalidMenuItem->translatedInput('label'),
                'url'       => null,
                'children'  => [],
            ],
        ];

        $this->assertEquals($expectedTree, MenuHelper::getItemsTree('header'));
    }
}
