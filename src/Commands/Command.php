<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Commands;

use Illuminate\Console\Command as BaseCommand;
use Symfony\Component\Process\Process;

class Command extends BaseCommand
{
    public function runProcess(array $command, ?string $cwd = null, ?int $timeout = 300): void
    {
        (new Process($command))
            ->setTty(Process::isTtySupported())
            ->setWorkingDirectory($cwd ?? getcwd())
            ->setTimeout($timeout)
            ->mustRun();
    }
}
