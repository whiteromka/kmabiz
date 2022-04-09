<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Notification;

/**
 * NotificationSearch represents the model behind the search form of `app\models\Notification`.
 */
class NotificationSearch extends Notification
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'integrator_id', 'status'], 'integer'],
            [['created_at', 'text', 'sent_at'], 'safe'],
        ];
    }

    /**
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Notification::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'integrator_id' => $this->integrator_id,
            'status' => $this->status
        ]);
        $query->andFilterWhere(['like', 'sent_at', $this->sent_at])
            ->andFilterWhere(['like', 'created_at', $this->created_at])
            ->andFilterWhere(['like', 'text', $this->text]);

        return $dataProvider;
    }
}
