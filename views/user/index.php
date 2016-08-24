<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('reserve', 'Reserve Car Uses');
$this->params['breadcrumbs'][] = $this->title;
?>

    <div class='box box-info'>
        <div class='box-header'>
            <h3 class='box-title'><?= Html::encode($this->title) ?></h3>
        </div><!--box-header -->

        <div class='box-body pad'>
            <div class="reserve-car-use-index">
            
            <!--<h1><?= Html::encode($this->title) ?></h1>-->
                        <p>
                <?= Html::a(Yii::t('reserve', 'Create Reserve Car Use'), ['create'], ['class' => 'btn btn-success']) ?>
            </p>
                                        <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                            'reserve_car_id',
            'reserve_car_oil_id',
            'liters_num',
            'amount',
            'returned_date',

                ['class' => 'yii\grid\ActionColumn'],
                ],
                ]); ?>
                                </div>
    </div><!--box-body pad-->
</div><!--box box-info-->
