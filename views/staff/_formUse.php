<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\modules\reserveCar\models\ReserveCarOil;
use kartik\datetime\DateTimePicker;

echo $model->statusLabel;


if (Yii::$app->user->can('staffFinance') && in_array($model->status, [3, 5])):
    $form = ActiveForm::begin();
    ?>

    <div class="box-body">
        <?= Html::tag('b', 'ส่วนของเจ้าที่หน้าที่ผู้อนุมัติ'); ?>
        <?= $form->field($model, 'id')->hiddenInput()->label(false) ?>
        <?= $form->field($modelUse, 'reserve_car_id')->hiddenInput()->label(false) ?>

        <?= $form->field($modelUse, 'reserve_car_oil_id')->dropDownList(ReserveCarOil::getList(),['prompt'=>'เลือก']) ?>

        <?= $form->field($modelUse, 'liters_num')->textInput(['maxlength' => true, 'type' => 'number']) ?>

        <?= $form->field($modelUse, 'amount')->textInput(['maxlength' => true, 'type' => 'number']) ?>

        <?= $form->field($modelUse, 'returned_date')->widget(DateTimePicker::className(),[
            
            
        ]) ?>

        <div class="form-group">
            <?= Html::submitButton($modelUse->isNewRecord ? Yii::t('reserve', 'Create') : Yii::t('reserve', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>


    </div>
    <?php
    ActiveForm::end();


endif;
?>
