<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Menahouse\Contracts\AdvertiseInterface',
                                        'Menahouse\Repositories\AdvertiseRepository');

        $this->app->bind('Menahouse\Contracts\CitiesInterface',
                                    'Menahouse\Repositories\CitiesRepository');

        $this->app->bind('Menahouse\Contracts\ImageManipulationInterface',
                                        'Menahouse\Repositories\ImageManipulationRepository');
                                        
        $this->app->bind('Menahouse\Contracts\UserMailerInterface',
                                        'Menahouse\Repositories\UserMailerRepository');

        $this->app->singleton('League\Glide\Server', function($app){

            $filesystem = $app->make('Illuminate\Contracts\Filesystem\Filesystem');

            return \League\Glide\ServerFactory::create([
                'source' => $filesystem->getDriver(),
                'cache' => $filesystem->getDriver(),
                'source_path_prefix' => 'images',
                'cache_path_prefix' => 'images/.cache'
            ]);

        });


            //                             $this->app->bind(
            // 'Menahouse\Repositories\UserRepositoryInterface',
            // 'Menahouse\Repositories\UserRepository'
       //);

    }
}
