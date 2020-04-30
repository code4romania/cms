<?php

namespace Code4Romania\Cms\Tests\Http\Middleware;

use Code4Romania\Cms\Http\Middleware\RedirectTrailingSlash;
use Code4Romania\Cms\Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\Request;

class RedirectTrailingSlashTest extends TestCase
{
    use WithoutMiddleware;

    protected function requestWithMiddleware(string $url)
    {
        return app(RedirectTrailingSlash::class)
            ->handle(Request::create($url, 'GET'), fn () => response('OK', 200))
            ->getStatusCode();
    }

    /** @test */
    public function itRemovesTrailingSlashFromUrl()
    {
        $page = $this->createPage();

        $this->assertEquals(301, $this->requestWithMiddleware("/en/{$page['model']->slug}/"));
        $this->assertEquals(200, $this->requestWithMiddleware("/en/{$page['model']->slug}"));
    }
}
