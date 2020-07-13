<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Commands;

class Build extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cms:build {--install}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Build the CMS frontend';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        if ($this->option('install')) {
            $this->info('Installing npm dependencies');
            $this->runProcess(['npm', 'install', '--no-save', '--prefer-offline', '--no-audit']);
        } else {
            $this->info('Reusing npm dependencies');
        }

        $this->info('Building the ckeditor');
        $this->runProcess(['npm', 'run', 'ckeditor:build']);

        $this->info('Building the public frontend');
        $this->runProcess(['npm', 'run', 'prod']);

        $this->info('Building the Twill frontend');
        $this->call('twill:build', ['--noInstall' => true]);
    }
}
