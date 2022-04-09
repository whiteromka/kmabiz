<?php

namespace app\components\notifiers;

use app\models\Notification;

abstract class AbstractNotifier
{
    protected Notification $notification;

    public function __construct(Notification $notification)
    {
        $this->notification = $notification;
    }

    /**
     * @return bool
     */
    public function send(): bool
    {
        $isSuccess = $this->sendRequest();
        $this->notification->status = $isSuccess ? Notification::STATUS_SENDING : Notification::STATUS_ERROR;
        $this->notification->sent_at = date('Y-m-d H:i:s');
        $this->notification->save();

        return $isSuccess;
    }

    abstract protected function sendRequest();
}