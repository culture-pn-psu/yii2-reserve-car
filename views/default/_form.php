<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\time\TimePicker;
use kartik\select2\Select2;
use culturePnPsu\reserveCar\models\ReserveCar;
use culturePnPsu\reserveCar\models\ReserveCarCate;
use culturePnPsu\reserveCar\models\ReserveCarPlaces;
?>

<?= Html::tag('h2', Yii::t('reserve', 'แบบฟอร์การขอใช้รถ'), ['class' => 'text-center']) ?>

<div class="row">
    <div class="col-sm-10 col-sm-offset-1">

        <div class="row">
            <div class="col-sm-2 col-sm-offset-10">
                <?= Yii::$app->formatter->asDate(time()); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <?= common\models\User::getFullname(); ?>
            </div>
        </div>


        <?php
        $form = ActiveForm::begin([
                    'options' => [
                        'id' => 'dynamic-form'
        ]]);
        ?>    

        <?php if(Yii::$app->user->can('staffFinance')):?>
        <?= $form->field($model, 'reserved_by')->dropDownList(ReserveCar::getPersonAll(), ['prompt' => 'เลือก']) ?>
        <?php endif;?>
        
        <?= $form->field($model, 'reserve_car_cate_id')->dropDownList(ReserveCarCate::getList(), ['prompt' => 'เลือก']) ?>



        <?=
        $this->render('_formGoto', [
            'model' => $model,
            'modelGoto' => $modelGoto,
            'form' => $form
        ]);
        ?>





        <div class = "row">
            <div class = "col-sm-4">
                <?=
                $form->field($model, 'date_start')->widget(DatePicker::className(), [
                    'options' => ['placeholder' => 'Enter birth date ...'],
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd'
                    ]
                        ]
                )
                ?>
            </div>
            <div class="col-sm-2">

                <?=
                $form->field($model, 'time_start')->widget(TimePicker::className(), [
                    'pluginOptions' => [
                        'showMeridian' => false,
                    ]
                ])
                ?>
            </div>
            <!--    </div>
                
                <div class="row">-->
            <div class="col-sm-4">
                <?=
                $form->field($model, 'date_end')->widget(DatePicker::className(), [
                    'options' => ['placeholder' => 'Enter birth date ...'],
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd'
                    ]
                        ]
                )
                ?>
            </div>
            <div class="col-sm-2">

                <?=
                $form->field($model, 'time_end')->widget(TimePicker::className(), [
                    'pluginOptions' => [
                        'showMeridian' => false,
                    ]
                ])
                ?>
            </div>
        </div>




        <?= $form->field($model, 'subject')->textarea()->label('ต้องการขอใช้รถเกี่ยวกับเรื่อง') ?>


        <div class="row">
            <div class="col-sm-6">
                <?=
                $form->field($model, 'reserve_car_places_id')->widget(Select2::className(), [
                    'data' => ReserveCarPlaces::getList()
                ])
                ?>
            </div>
            <div class="col-sm-3">
                <?= $form->field($model, 'passenger')->textInput(['maxlength' => true, 'type' => 'number']) ?>
            </div>
            <div class="col-sm-3">
                <?= $form->field($model, 'tel')->textInput(['maxlength' => true]) ?>


            </div>
        </div> 
        <?= $form->field($model, 'note')->textarea() ?>
        
        <div class="form-group">
            <?= Html::submitButton(Yii::t('reserve', 'บันทึก'), ['class' => 'btn btn-primary', 'name' => 'save']) ?> 
            <?= Html::submitButton(Yii::t('reserve', 'ยื่นขอรถ'), ['class' => 'btn btn-success', 'name' => 'send']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>