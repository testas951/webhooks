<?php

namespace App\Http\Controllers;

use App\Exceptions\WebhookFailed;
use App\Models\Notification;
use App\Models\NotificationPayload;
use Illuminate\Http\Request;

class WebhooksController extends Controller
{
    private $typesArray;

    function __construct()
    {
        $this->typesArray = array(
            'apple'
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param string $type
     * @return \Illuminate\Http\JsonResponse
     * @throws WebhookFailed
     */
    public function index(Request $request, string $type): \Illuminate\Http\JsonResponse
    {
        if (!in_array($type, $this->typesArray)) abort(404);

        Notification::storeNotification($type, $request->input());

        $method = config("payment-notifications.method.{$type}", null);

        if (!method_exists(NotificationPayload::class, $method)
            || !is_callable(array(NotificationPayload::class, $method)))
        {
            throw WebhookFailed::methodDoesNotExist($method);
        }

        $payload = NotificationPayload::$method($request);
        $notificationType = $payload->notificationType();

        $jobClass = config("payment-notifications.jobs.{$type}.{$notificationType}", null);

        if (is_null($jobClass)) {
            throw WebhookFailed::jobClassByNotificationTypeDoesNotExist($type, $notificationType);
        }

        $job = new $jobClass($payload);
        dispatch($job);

        return response()->json();
    }
}
