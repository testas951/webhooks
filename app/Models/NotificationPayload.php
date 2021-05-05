<?php

namespace App\Models;

use Illuminate\Http\Request;

class NotificationPayload
{
    private $environment;
    private $notificationType;
    private $password;
    private $autoRenewStatus;
    private $autoRenewProductId;
    private $autoRenewStatusChangeDate;
    private $autoRenewStatusChangeDatePst;
    private $autoRenewStatusChangeDateMs;
    private $userIdentifier;

    public function __construct()
    {
    }

    public static function createFromAppleRequest(Request $request): NotificationPayload
    {
        $instance = new self();
        $instance->environment = $request->input('environment');
        $instance->password = $request->input('password');
        $instance->notificationType = $request->input('notification_type');
        $instance->userIdentifier = $request->input('auto_renew_adam_id');

        //TO DO create receipt
        //$instance->latestReceiptInfo = Receipt::createFromArray($request->input('unified_receipt'));

        $instance->autoRenewStatus = $request->input('auto_renew_status');
        $instance->autoRenewProductId = $request->input('auto_renew_product_id');
        $instance->autoRenewStatusChangeDate = $request->input('auto_renew_status_change_date');
        $instance->autoRenewStatusChangeDatePst = $request->input('auto_renew_status_change_date_pst');
        $instance->autoRenewStatusChangeDateMs = $request->input('auto_renew_status_change_date_ms');

        return $instance;
    }

    /**
     * Get the value of environment.
     */
    public function getEnvironment()
    {
        return $this->environment;
    }

    /**
     * Get the value of environment.
     */
    public function getUserIdentifier()
    {
        return $this->userIdentifier;
    }

    /**
     * Get the value of notificationType.
     */
    public function getNotificationType()
    {
        return $this->notificationType;
    }


    /**
     * Get the value of autoRenewStatusChangeDateMs.
     */
    public function getAutoRenewStatusChangeDateMs()
    {
        return $this->autoRenewStatusChangeDateMs;
    }

    /**
     * Get the value of autoRenewStatusChangeDatePst.
     */
    public function getAutoRenewStatusChangeDatePst()
    {
        return $this->autoRenewStatusChangeDatePst;
    }

    /**
     * Get the value of autoRenewStatusChangeDate.
     */
    public function getAutoRenewStatusChangeDate()
    {
        return $this->autoRenewStatusChangeDate;
    }

    /**
     * Get the value of autoRenewProductId.
     */
    public function getAutoRenewProductId()
    {
        return $this->autoRenewProductId;
    }

    /**
     * Get the value of autoRenewStatus.
     */
    public function getAutoRenewStatus()
    {
        return $this->autoRenewStatus;
    }

    /**
     * Get the value of password.
     */
    public function getPassword()
    {
        return $this->password;
    }
}
