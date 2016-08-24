<?php
use yii\helpers\Html;
use yii\widgets\DetailView;


?>


<div class='box-body pad'>
    <?php
    /*
     echo Yii::$app->getTimeZone();
    date('Y-m-d H:i:s'); // <?php echo date('Y-m-d H:i:s');?><br/>
    Yii::$app->formatter->asDatetime(date('Y-m-d H:i:s')); // <?php echo Yii::$app->formatter->asDatetime(date('Y-m-d H:i:s'));?><br/>
    Yii::$app->formatter->asDatetime(time()); // <?php echo Yii::$app->formatter->asDatetime(time());?><br/>
    Yii::$app->formatter->asDatetime(date('u')); // <?php echo Yii::$app->formatter->asDatetime(date('U'));?><br/>
    <?=$model->time_start?>
    <?=Yii::$app->formatter->asTime($model->time_start)?>
    */?>
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
                

            </div>
        </div>
    </div><!--box-body pad-->

