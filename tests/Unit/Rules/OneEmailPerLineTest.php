<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Tests\Rules;

use Code4Romania\Cms\Rules\OneEmailPerLine;
use Code4Romania\Cms\Tests\TestCase;

class OneEmailPerLineTest extends TestCase
{
    /** @var OneEmailPerLine */
    protected $rule;

    protected function setUp(): void
    {
        parent::setUp();

        $this->rule = new OneEmailPerLine();
    }

    /**
     * @test
     * @dataProvider oneEmailPerLine
     */
    public function it_passes_valid_input(string $input)
    {
        $this->assertTrue($this->rule->passes('test', $input));
    }

    /**
     * @test
     * @dataProvider multipleEmailsPerLine
     */
    public function it_fails_invalid_input(string $input)
    {
        $this->assertFalse($this->rule->passes('test', $input));
    }

    public function oneEmailPerLine(): array
    {
        return [
            'single' => ["test1@example.net"],
            '\n'     => ["test2@example.net\ntest2@example.org"],
            '\r'     => ["test3@example.net\rtest3@example.org"],
            '\r\n'   => ["test4@example.net\r\ntest4@example.org"],
        ];
    }

    public function multipleEmailsPerLine(): array
    {
        return [
            'space' => ["test2@example.net test2@example.org"],
            'comma' => ["test3@example.net,test3@example.org"],
            'tab'   => ["test4@example.net\ttest4@example.org"],
        ];
    }
}
