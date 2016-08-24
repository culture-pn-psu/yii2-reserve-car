<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model culturePnPsu\reserveCar\models\ReserveCarStaffSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reserve-car-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'subject') ?>

    <?= $form->field($model, 'status') ?>

    <?= $form->field($model, 'date_start') ?>

    <?= $form->field($model, 'time_start') ?>

    <?php // echo $form->field($model, 'date_end') ?>

    <?php // echo $form->field($model, 'time_end') ?>

    <?php // echo $form->field($model, 'reserve_car_places_id') ?>

    <?php // echo $form->field($model, 'reserve_car_cate_id') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'reserved_at') ?>

    <?php // echo $form->field($model, 'reserved_by') ?>

    <?php // echo $form->field($model, 'passenger') ?>

    <?php // echo $form->field($model, 'tel') ?>

    <?php // echo $form->field($model, 'note') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('reserve', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('reserve', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
