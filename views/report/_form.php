<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Month;

/* @var $this yii\web\View */
/* @var $model culturePnPsu\reserveCar\models\ReserveCarReport */
/* @var $form yii\widgets\ActiveForm */
if($model->isNewRecord){
    $model->month = date('n');
    $model->year = date('Y') + 543;
}else{
    $model->year += 543;
}
?>

<div class="reserve-car-report-form">

<?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-sm-2">
<?= $form->field($model, 'month')->dropDownList(Month::getLabel()) ?>

        </div>
        <div class="col-sm-2">
<?= $form->field($model, 'year')->textInput(['maxlength' => true, 'type' => 'number', 'min' => date('Y') + 543]) ?>
        </div>
    </div>

<?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>

    <div class="form-group">
<?= Html::submitButton($model->isNewRecord ? Yii::t('reserve', 'Create') : Yii::t('reserve', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>

</div>
