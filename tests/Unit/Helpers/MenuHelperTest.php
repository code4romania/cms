<?php

namespace Code4Romania\Cms\Tests\Helpers;

use Code4Romania\Cms\Helpers\MenuHelper;
use Code4Romania\Cms\Repositories\MenuItemRepository;
use Code4Romania\Cms\Repositories\PageRepository;
use Code4Romania\Cms\Tests\TestCase;

class MenuHelperTest extends TestCase
{

    protected function createMenuItem(string $location, string $type, string $target, ?int $parent_id = null): array
    {
        $locales = $this->getAvailableLocales();

        $attributes = collect([
            'position'  => $this->faker->randomDigitNotNull,
            'location'  => $location,
            'type'      => $type,
            'target'    => $target,
            'parent_id' => $parent_id,

            'label' => $locales
                ->mapWithKeys(fn ($locale) => [$locale => $this->faker->word]),

            'languages' => $locales
                ->map(fn ($locale) => ['value' => $locale, 'published' => true]),
        ])->toArray();

        return [
            'attributes' => $attributes,
            'model'      => app(MenuItemRepository::class)->create($attributes),
        ];
    }

    protected function createPage()
    {
        $locales = $this->getAvailableLocales();

        $attributes = collect([
            'languages' => $locales
                ->map(fn ($locale) => ['value' => $locale, 'published' => true]),

            'title' => $locales
                ->mapWithKeys(fn ($locale) => [$locale => $this->faker->word]),

            'slug' => $locales
                ->mapWithKeys(fn ($locale) => [$locale => $this->faker->slug]),
        ])->toArray();

        return [
            'attributes' => $attributes,
            'model'      => app(PageRepository::class)->create($attributes),
        ];
    }

    /** @test */
    public function itReturnsAnEmptyArrayForAnUnkownMenuLocation()
    {
        $this->assertEmpty(MenuHelper::getItemsTree('doesNotExist'));
    }

    /** @test */
    public function itReturnsAnArrayForAKownMenuLocation()
    {
        $externalMenuItem = $this->createMenuItem('header', 'external', $this->faker->url);

        $page = $this->createPage();

        $pageMenuItem = $this->createMenuItem('header', 'page', $page['model']->id);
        $subMenuItem = $this->createMenuItem('header', 'external', $this->faker->url, $externalMenuItem['model']->id);
        $invalidMenuItem = $this->createMenuItem('header', 'doesNotExist', '#');

        $expectedTree = [
            [
                'type'     => 'external',
                'label'    => $externalMenuItem['model']->label,
                'url'      => $externalMenuItem['attributes']['target'],
                'children' => [
                    [
                        'type'     => 'external',
                        'label'    => $subMenuItem['model']->label,
                        'url'      => $subMenuItem['attributes']['target'],
                        'children' => [],
                    ],
                ],
            ],
            [
                'type'     => 'page',
                'label'    => $pageMenuItem['model']->label,
                'url'      => route('front.pages.show', $page['model']->slug),
                'children' => [],
            ],
            [
                'type'     => 'doesNotExist',
                'label'    => $invalidMenuItem['model']->label,
                'url'      => null,
                'children' => [],
            ],
        ];

        $this->assertEquals($expectedTree, MenuHelper::getItemsTree('header'));
    }
}
