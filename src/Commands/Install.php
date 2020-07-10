<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Commands;

use A17\Twill\TwillServiceProvider;
use Code4Romania\Cms\CmsServiceProvider;
use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Process\Process;

class Install extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cms:install {--y|yes : Automatic yes to initial prompt} ' .
        '{--build} {--noInstall}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install CMS features';

    /** @var Filesystem */
    protected $files;

    /** @var DatabaseManager */
    protected $database;

    /**
     * Create a new command instance.
     */
    public function __construct(Filesystem $files, DatabaseManager $database)
    {
        parent::__construct();

        $this->files = $files;
        $this->database = $database;
    }

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->warn('This is a potentially destructive action!');
        $this->warn('It will (re)publish and overwrite all the files provided by this package.');

        if (!$this->option('yes') && !$this->confirm('Are you sure you want to continue?')) {
            return;
        }

        $this->warn('You have been warned.');

        $this->removeFiles();
        $this->publish('migrations', true);
        $this->publish();
        $this->installTwill();
        $this->buildFrontend();
    }

    private function runProcess(array $command, ?int $timeout = 300): void
    {
        (new Process($command))
            ->setTty(Process::isTtySupported())
            ->setTimeout($timeout)
            ->mustRun();
    }

    public function checkDatabaseConnection(): bool
    {
        try {
            $this->database->connection()->getPdo();
        } catch (\Exception $exception) {
            return false;
        }

        return true;
    }

    private function removeFiles(): void
    {
        $this->line('');

        $this->info('Emptying the resources directory.');
        $this->files->cleanDirectory(resource_path());

        $this->info('Blanking the default route files.');
        collect($this->files->files(base_path('routes')))
            ->each(function ($file) {
                $this->files->replace(
                    $file->getPathname(),
                    '<?php // this file is intentionally left blank'
                );
            });

        $this->info('Deleting previously copied files.');

        $filesToDelete = [
            base_path('.gitignore'),
            base_path('.env.example'),
            database_path('migrations/2014_10_12_000000_create_users_table.php'),
            database_path('migrations/2014_10_12_100000_create_password_resets_table.php'),
            database_path('migrations/2019_08_19_000000_create_failed_jobs_table.php'),
        ];

        $assetFiles = collect(CmsServiceProvider::$assetFiles)
            ->map(fn ($fileName): string => base_path($fileName));

        $configFiles = collect(CmsServiceProvider::$configFiles)
            ->map(fn ($fileName): string => config_path($fileName));

        collect($filesToDelete)
            ->merge($configFiles)
            ->merge($assetFiles)
            ->each(function ($filePath): void {
                if ($this->files->isDirectory($filePath)) {
                    $this->info("Removed Directory <warning>[{$filePath}]</warning>");
                    $this->files->deleteDirectory($filePath);
                } else {
                    $this->info("Removed File <warning>[{$filePath}]</warning>");
                    $this->files->delete($filePath);
                }
            });

        $this->info('Deleting complete.');
        $this->line('');
    }

    private function installTwill(): void
    {
        if ($this->confirm('Do you also want to run the Twill install process?')) {
            $this->call('vendor:publish', [
                '--provider' => TwillServiceProvider::class,
                '--tag' => 'migrations',
            ]);

            if ($this->checkDatabaseConnection()) {
                $this->call('twill:install');
            } else {
                $this->line('');
                $this->warn('After configuring the database access, you still need to run `php artisan twill:install`');
            }
        }
    }

    private function buildFrontend(): void
    {
        if (!$this->option('build') && !$this->confirm('Do you want to build the frontend?')) {
            return;
        }

        if (!$this->option('noInstall')) {
            $this->info('Installing npm dependencies');
            $this->runProcess(['npm', 'install', '--no-save', '--prefer-offline', '--no-audit']);
        } else {
            $this->info('Reusing npm dependencies');
        }

        $this->info('Building the ckeditor');
        $this->runProcess(['npm', 'run', 'ckeditor:build']);

        $this->info('Building the twill frontend');
        $this->call('twill:build');

        $this->info('Building the public frontend');
        $this->runProcess(['npm', 'run', 'prod']);
    }

    /**
     * Publishes a specific tag
     */
    private function publish(?string $tag = null, bool $force = false): void
    {
        $arguments = [
            '--provider' => CmsServiceProvider::class,
        ];

        if (!is_null($tag)) {
            $arguments['--tag'] = $tag;
        }

        if ($force) {
            $arguments['--force'] = true;
        }

        $this->info('Publishing vendor files.');
        $this->call('vendor:publish', $arguments);
        $this->line('');
    }
}
