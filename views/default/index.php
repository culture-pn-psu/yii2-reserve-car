<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel culturePnPsu\reserveCar\models\ReserveCarSearch */
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
                            'passenger',
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
                            ],
                            [
                                'attribute' => 'status',
                                'format' => 'html',
                                'value' => 'statusLabel'
                            ],
                            // 'reserve_car_places_id',
                            // 'reserve_car_cate_id',
                            // 'created_at',
                            'reserved_at:datetime',
                            [
                                'attribute' => 'reserved_by',
                                'value' => 'reservedBy.displayname',
                            ],
                            [
                                'attribute' => 'created_by',
                                'value' => 'createdBy.displayname',
                            ],
                            // 'tel',
                            // 'note',
                            ['class' => 'yii\grid\ActionColumn'],
                        ],
                    ]);
                    ?>
                    <?php Pjax::end(); ?>        
        </div>
    </div><!--box-body pad-->
</div><!--box box-info-->
