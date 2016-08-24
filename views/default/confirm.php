<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model culturePnPsu\reserveCar\models\ReserveCar */

$this->title = $model->subject;
$this->params['breadcrumbs'][] = ['label' => Yii::t('reserve', 'Reserve Cars'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class='box'>
    <!--    <div class='box-header hidden-print'>
            <h3 class='box-title'><?= Html::encode($this->title) ?></h3>  
        </div>-->
    <!--box-header -->

    <div class='box-body pad'>

        <?= Html::tag('h3', Yii::t('reserve', 'แบบฟอร์การขอใช้รถ'), ['class' => 'text-center']) ?>
        <?= Html::tag('h4', Yii::$app->name, ['class' => 'text-center visible-print']) ?>

        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <div class="row">
                    <div class="col-sm-3 col-sm-offset-9 text-right">
                        <label>วันที่ </label> <?= Yii::$app->formatter->asDate(time()); ?>
                    </div>
                    <div class="col-sm-12">
                        <label>เรื่อง</label> ขอใช้รถไปราชการ 
                    </div>
                    <div class="col-sm-12">
                        <label>ผู้ขอใช้รถ</label> <?= $model->reservedBy->displayname; ?> 
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <?=
                DetailView::widget([
                    'model' => $model,
                    'options' => ['class' => 'table'],
                    'template' => '<tr><th width="30%" class="text-right">{label}</th><td>{value}</td></tr>',
                    'attributes' => [
                        [
                            'label' => 'ขอใช้รถเกี่ยวกับเรื่อง',
                            'attribute' => 'subject',
                        ],
                        [
                            'attribute' => 'reserve_car_cate_id',
                            'value' => $model->reserveCarCate->title
                        ],
                        [
                            'attribute' => 'gotos',
                            'format' => 'html',
                            'value' => $model->gotos
                        ],
                        [
                            'attribute' => 'passenger',
                            'value' => $model->passenger . " คน"
                        ],
                        [
                            'attribute' => 'reserve_car_places_id',
                            'value' => $model->reserveCarPlaces->title
                        ],
                        'tel',
                        [
                            'attribute' => 'date_start',
                            'value' => Yii::$app->formatter->asDatetime($model->dateTimeStart)
                        ],
                        [
                            'attribute' => 'date_end',
                            'value' => Yii::$app->formatter->asDatetime($model->dateTimeEnd)
                        ],
                        'note',
                        'created_at:datetime'
                    ],
                ])
                ?>
                <?php
                $form = ActiveForm::begin([
                            'options' => [
                                'id' => 'dynamic-form'
                ]]);
                ?>  
                <?= $form->field($model, 'id')->hiddenInput()->label(false)->hint(false) ?>

                <div class="form-group">
                    <?= Html::a(Yii::t('reserve', 'แก้ไข'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                    <?= Html::submitButton(Yii::t('reserve', 'ยื่นขอรถ'), ['class' => 'btn btn-success', 'name' => 'send']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div><!--box-body pad-->
</div><!--box box-info-->
