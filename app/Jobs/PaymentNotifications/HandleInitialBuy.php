<?php


namespace App\Jobs\PaymentNotifications;


use App\Models\Subscription;
use Carbon\Carbon;

class HandleInitialBuy
{
    protected $payload;

    public function __construct($payload)
    {
        $this->payload = $payload;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Subscription::storeSubscription($this->payload, 'INITIAL_BUY', Carbon::now()->addYears(1));
    }
}
