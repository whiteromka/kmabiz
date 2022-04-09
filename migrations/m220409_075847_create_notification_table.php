<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%notification}}`.
 */
class m220409_075847_create_notification_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%notification}}', [
            'id' => $this->primaryKey(),
            'text' => $this->string(),
            'integrator_id' => $this->tinyInteger()->comment('ID интегратора'),
            'status' => $this->tinyInteger()->comment('ID интегратора'),
            'created_at' => $this->timestamp(),
            'sent_at' => $this->timestamp()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%notification}}');
    }
}
