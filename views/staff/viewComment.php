<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

//if (isset($model->staffMaterial_id) && $model->status > 1):

echo $model->statusLabel;
if (Yii::$app->user->can('staffFinance') && in_array($model->status, [1, 2])):
    $form = ActiveForm::begin();
    echo $form->field($model, "id")->label(false)->hiddenInput();
    ?>
    <div class="box box-widget">
        <div class="box-body">
            <?= Html::tag('b', 'ส่วนของเจ้าที่หน้าที่ผู้อนุมัติ'); ?>

        </div>



        <div class="box-footer box-comments">
            <div class="box-comment">
                <div class="comment-text"> 
                    <div class="form-group">               
                        <?= Html::submitButton(Yii::t('system', 'จองรถ'), ['class' => 'btn btn-success', 'name' => 'btnReserv']) ?> 

                        <?= Html::submitButton(Yii::t('system', 'รถไม่ว่าง'), ['class' => 'btn btn-danger', 'name' => 'btnBusy']) ?> 
                    </div>
                </div>
            </div>
        </div>

    </div>
    <?php
    ActiveForm::end();


endif;

