<?php

namespace app\models;

use app\components\behaviors\NotificationBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "notification".
 *
 * @property int $id
 * @property string $text
 * @property int|null $integrator_id ID интегратора
 * @property int|null $status ID интегратора
 * @property string $created_at
 * @property string|null $sent_at
 */
class Notification extends \yii\db\ActiveRecord
{
    public const STATUS_WAITING = 0;

    public const STATUS_SENDING = 1;

    public const STATUS_ERROR = 3;

    public const INTEGRATOR_SMS = 0;

    public const INTEGRATOR_TELEGRAM = 1;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'notification';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['integrator_id', 'status'], 'integer'],
            ['text', 'string'],
            ['status', 'default', 'value' => self::STATUS_WAITING],
            [['created_at', 'sent_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'text' => 'Сообщение',
            'integrator_id' => 'Интегратор',
            'status' => 'Статус',
            'created_at' => 'Создано',
            'sent_at' => 'Отправлено',
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => false,
                'value' => new Expression('NOW()'),
            ],
            NotificationBehavior::class
        ];
    }

    /**
     * @return string[]
     */
    public static function getStatuses() : array
    {
        return [
            self::STATUS_WAITING => 'Ожидание',
            self::STATUS_SENDING => 'Отправлено',
            self::STATUS_ERROR => 'Ошибка'
        ];
    }

    /**
     * @return string[]
     */
    public static function getIntegrators() : array
    {
        return [
            self::INTEGRATOR_SMS => 'Sms',
            self::INTEGRATOR_TELEGRAM => 'Telegram'
        ];
    }

    /**
     * @return bool
     */
    public function isSms(): bool
    {
        return $this->integrator_id == self::INTEGRATOR_SMS;
    }

    /**
     * @return bool
     */
    public function isTelegram(): bool
    {
        return $this->integrator_id == self::INTEGRATOR_TELEGRAM;
    }
}
