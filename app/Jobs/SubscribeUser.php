<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class SubscribeUser implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    private $notification_type;
    private $purchase_token;


    public function __construct($notification_type, $purchase_token)
    {
        $this->notification_type = $notification_type;
        $this->purchase_token = $purchase_token;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $subscribe_codes = [1, 2, 4, 7];
        $unsubscribe_codes = [3, 5, 10, 12, 13];

        $user = User::where('gplay_order_token', $this->purchase_token)
            ->first();

        if ($user) {
            if (in_array($this->notification_type, $subscribe_codes)) {
                $user->setSubscribed()->save();
            }

            if (in_array($this->notification_type, $unsubscribe_codes)) {
                $user->setUnsubscribed()->save();
            }
        }
    }
}
