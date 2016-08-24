<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model culturePnPsu\reserveCar\models\ReserveCarUse */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reserve-car-use-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'reserve_car_id')->textInput() ?>

    <?= $form->field($model, 'reserve_car_oil_id')->textInput() ?>

    <?= $form->field($model, 'liters_num')->textInput() ?>

    <?= $form->field($model, 'amount')->textInput() ?>

    <?= $form->field($model, 'returned_date')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('reserve', 'Create') : Yii::t('reserve', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
