<?php

namespace app\components\notifiers\jobs;

use app\components\notifiers\SmsNotifier;
use app\components\notifiers\TelegramNotifier;
use app\models\Notification;
use yii\queue\JobInterface;
use yii\base\BaseObject;


class NotificationJob extends BaseObject implements JobInterface
{
    public Notification $notification;

    public function execute($queue)
    {
        if ($this->notification->isSms()) {
            (new SmsNotifier($this->notification))->send();
        }
        else if ($this->notification->isTelegram()) {
            (new TelegramNotifier($this->notification))->send();
        }
    }
}