<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Elasticsearch\ClientBuilder;


class ElasticsearchServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('elasticsearch', function ($app) {
            return ClientBuilder::create()
                ->setHosts(config('database.connections.elasticsearch.hosts'))
                ->build();
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
