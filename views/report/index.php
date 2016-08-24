<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\modules\reserveCar\models\ReserveCarReport;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\reserveCar\models\ReserveCarReportSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('reserve', 'รายงานการใช้พลังงาน');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class='box box-info'>
    <div class='box-header'>
        <h3 class='box-title'><?= Html::encode($this->title) ?></h3>
    </div><!--box-header -->

    <div class='box-body pad'>
        <div class="reserve-car-report-index">


            <p>
                <?= Html::a(Yii::t('reserve', 'ออกรายงาน'), ['create'], ['class' => 'btn btn-success']) ?>
            </p>
            <?php Pjax::begin(); ?>                            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => 'month',
                        'filter' => \backend\models\Month::getLabel(),
                        'format'=>'html',
                        'value' => function($model) {
                            return Html::a($model->monthLabel, ['view', 'month' => $model->month,'year'=>$model->year]);
                        }
                            ],
                            [
                                'attribute' => 'year',
                                'filter' => ReserveCarReport::getYears(),
                                'value' => 'yearLabel'
                            ],
                            'comment:ntext',
                            'created_at:datetime',
                            [
                                'attribute' => 'created_by',
                                'value' => 'createdBy.displayname'
                            ],
                            // 'updated_at',
                            // 'updated_by',
                            ['class' => 'yii\grid\ActionColumn'],
                        ],
                    ]);
                    ?>
                    <?php Pjax::end(); ?>        </div>
    </div><!--box-body pad-->
</div><!--box box-info-->
