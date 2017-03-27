<?php

namespace App\Providers;

use App\Observers\ElasticsearchNedvizhimostsObserver ;
use App\Nedvizhimosts;
use Elasticsearch\Client;

use Illuminate\Support\ServiceProvider;

class ObserversServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
     public function boot()
     {
         Nedvizhimosts::observe($this->app->make( ElasticsearchNedvizhimostsObserver::class ));
     }

     /**
      * Register any application services.
      *
      * @return void
      */
     public function register()
     {
         $this->app->bindShared(ElasticsearchNedvizhimostsObserver::class, function($app){
              return new ElasticsearchNedvizhimostsObserver(new Client());
         });

      //    $this->app->bindShared(ElasticsearchNedvizhimostsObserver::class, function()
      //  {
      //      return new ElasticsearchNedvizhimostsObserver(new Client());
      //  });
     }
}
