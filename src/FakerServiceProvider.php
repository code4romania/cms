<?php


declare(strict_types=1);

namespace Code4Romania\Cms;

use Code4Romania\Cms\Faker\PicsumImageProvider;
use Faker\Factory;
use Faker\Generator;
use Illuminate\Support\ServiceProvider;

class FakerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Generator::class, static function () {
            $faker = Factory::create();
            $faker->addProvider(new PicsumImageProvider($faker));

            return $faker;
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
