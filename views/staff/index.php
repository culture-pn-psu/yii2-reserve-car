<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\reserveCar\models\ReserveCarSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('reserve', 'รายการขอใช้รถ');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class='box box-info'>
    <div class='box-header'>
        <h3 class='box-title'><?= Html::encode($this->title) ?></h3>
    </div><!--box-header -->

    <div class='box-body pad'>
        <div class="reserve-car-index">


            <?php Pjax::begin(); ?>                            
            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => 'subject',
                        'format' => 'html',
                        'value' => function($model) {
                            return Html::a($model->subject, ['view', 'id' => $model->id]);
                        },
                            ],
                            [
                                'attribute' => 'reserve_car_cate_id',
                                'value' => 'reserveCarCate.title',
                            ],
                            [
                                'attribute' => 'passenger',
                                'value' => function($model) {
                                    return $model->passenger . " คน";
                                },
                            ],
                            [
                                'attribute' => 'date_start',
                                'format' => 'datetime',
                                'value' => 'dateTimeStart',
                            ],
                            [
                                'attribute' => 'date_end',
                                'format' => 'datetime',
                                'value' => 'dateTimeEnd',
                            ],
                            [
                                'attribute' => 'reserve_car_places_id',
                                'value' => 'reserveCarPlaces.title',
                                'visible' => Yii::$app->chkRout->action('index')
                            ],
                            [
                                'attribute' => 'status',
                                'format' => 'html',
                                'value' => 'statusLabel',
                                'visible' => Yii::$app->chkRout->action('index') || Yii::$app->chkRout->action('result')
                            ],
                            // 'reserve_car_places_id',
                            // 'reserve_car_cate_id',
                            // 'created_at',
                            [
                                'attribute' => 'reserved_at',
                                'format' => 'datetime',
                                'visible' => Yii::$app->chkRout->action('index')
                            ],
                            [
                                'attribute' => 'reserved_by',
                                'value' => 'reservedBy.displayname',
                            ],
                            [
                                'content' => function($model) {
                                    if ($model->reserveCarUse && $model->status ==3){
                                        return Html::a('กรอกน้ำมัน', ['use', 'id' => $model->id], ['class' => 'btn btn-primary']);
                                    }elseif($model->status ==1){
                                        return Html::a('ตรวจสอบ', ['view', 'id' => $model->id], ['class' => 'btn btn-primary']);
                                    }else{
                                       return Html::a('ดูรายละเอียด', ['view', 'id' => $model->id], ['class' => 'btn btn-primary']); 
                                    }
                                },
                                    ],
                                ],
                            ]);
                            ?>
                            <?php Pjax::end(); ?>        
        </div>
    </div><!--box-body pad-->
</div><!--box box-info-->
