<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Models\Prompt;
use Elastic\Elasticsearch\ClientBuilder;


class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        // code for elastic search has been disabled
        // Prompt::created(function ($prompt) {
        //     // code to connect to elastic search locally
        //     // $client = ClientBuilder::create()
        //     //     ->setHosts([env('ELASTICSEARCH_HOST')])
        //     //     ->build();

        //     // code to connect to elastic search on elastic cloud
        //     $client = ClientBuilder::create()
        //         ->setElasticCloudId(env('ELASTICSEARCH_USER'))
        //         ->setBasicAuthentication('elastic', env('ELASTICSEARCH_PASS'))
        //         ->build();


        //     $params = [
        //         // 'index' => 'my_index',
        //         'index' => 'chatchallet',
        //         'id' => $prompt->id,
        //         'body' => [
        //             'prompt' => $prompt->prompt,
        //             'chat_id' => $prompt->chat_id,
        //             'user_id' => $prompt->user_id,
        //         ],
        //     ];


        //     $client->index($params);
        // });
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
