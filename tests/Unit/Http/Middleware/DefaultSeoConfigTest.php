<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Tests\Http\Middleware;

use Code4Romania\Cms\Helpers\SettingsHelper;
use Code4Romania\Cms\Models\Page;
use Code4Romania\Cms\Tests\TestCase;

class DefaultSeoConfigTest extends TestCase
{
    /** @test */
    public function itRemovesTrailingSlashFromUrl()
    {
        $page = factory(Page::class)
            ->states('published')
            ->create();

        SettingsHelper::set(['frontPage' => $page->id], 'site');

        $config = [
            'siteTitle'       => $this->faker->word,
            'siteDescription' => $this->faker->paragraph,
        ];

        SettingsHelper::set($config, 'seo');

        $this->visitRoute('front.pages.index')
            ->see('<title>' . $config['siteTitle'] . '</title>')
            ->see('<meta property="og:title" content="' . $config['siteTitle'] . '">')
            ->see('<meta property="og:site_name" content="' . $config['siteTitle'] . '">')

            ->see('<meta name="description" content="' . $config['siteDescription'] . '">')
            ->see('<meta property="og:description" content="' . $config['siteDescription'] . '">');
    }
}
