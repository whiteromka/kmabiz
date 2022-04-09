<?php

use app\models\Notification;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\NotificationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Уведомления';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notification-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать уведомление', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <p>Данные обновляюстя фоновым процессом (в очередях), поэтому отображаются не всегда в актуальном состоянии
        <a href="/notification/index"> обновить </a>
    </p>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'text',
            [
                'attribute' => 'integrator_id',
                'filter' => Notification::getIntegrators(),
                'value' => function(Notification $model) {
                    return ArrayHelper::getValue(Notification::getIntegrators(), $model->integrator_id);
                }
            ],
            [
                'attribute' => 'status',
                'filter' => Notification::getStatuses(),
                'value' => function(Notification $model) {
                    return ArrayHelper::getValue(Notification::getStatuses(), $model->status);
                }
            ],
            'created_at',
            'sent_at',
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, Notification $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
