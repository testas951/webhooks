<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    public static function storeSubscription(NotificationPayload $payload, string $status, Carbon $valid_to)
    {
        return self::create(
            [
                'user_identifier' => $payload->getUserIdentifier(),
                'subscription_id' => $payload->getAutoRenewProductId(),
                'status' => $status,
                'valid_to' => $valid_to
            ]
        );
    }

    public static function updateSubscription(NotificationPayload $payload, string $string, Carbon $valid_to)
    {

    }
}
