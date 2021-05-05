<?php


namespace App\Jobs\PaymentNotifications;


use App\Models\Subscription;
use Carbon\Carbon;

class HandleRenewal
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
        $subscription = Subscription::where('user_identifier', $this->payload->getUserIdentifier())
            ->where('subscription_id', $this->payload->getAutoRenewProductId())->first();

        Subscription::updateSubscription($this->payload, 'DID_RENEW', Carbon::now()->addYears(1));
    }
}
