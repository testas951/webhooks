<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 */
class Notification extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function storeNotification(string $type, array $notificationPayload)
    {
        return self::create(
            [
                'type' => $type,
                'payload' => json_encode($notificationPayload),
            ]
        );
    }
}
