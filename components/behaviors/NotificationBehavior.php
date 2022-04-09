<?php

namespace app\components\behaviors;

use app\components\notifiers\jobs\NotificationJob;
use app\models\Notification;
use yii\queue\file\Queue;
use yii\db\ActiveRecord;
use yii\base\Behavior;
use yii\base\Event;
use Yii;

class NotificationBehavior extends Behavior
{
    /**
     * @return string[]
     */
    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_INSERT => 'tryToSend',
        ];
    }

    public function tryToSend(Event $event): void
    {
        /** @var Notification $notification */
        $notification = $event->sender;

        /** @var Queue $queue */
        $queue = Yii::$app->get('queue');
        $queue->push(new NotificationJob(['notification' => $notification]));
    }
}