<?php

namespace App\Exceptions;

use Exception;

class WebhookFailed extends Exception
{
    public static function nonValidRequest()
    {
        return new static("Your shared secret does not match password in Apple's request", 400);
    }

    public static function jobClassByNotificationTypeDoesNotExist(string $type, string $jobClass)
    {
        return new static("Could not process webhook because the configured job `$jobClass` does not exist for '$type' payment.", 501);
    }

    public static function methodDoesNotExist(string $method)
    {
        return new static("Could not process webhook because the configured method `$method` does not exist.", 501);
    }

    public function render($request)
    {
        return response(['error' => $this->getMessage()], 400);
    }
}
