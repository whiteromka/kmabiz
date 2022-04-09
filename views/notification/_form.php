<?php

use app\models\Notification;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Notification */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="notification-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'text')->textarea() ?>

    <?= $form->field($model, 'integrator_id')->dropDownList(Notification::getIntegrators()) ?>

    <?= $form->field($model, 'status')->dropDownList(Notification::getStatuses()) ?>


    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
