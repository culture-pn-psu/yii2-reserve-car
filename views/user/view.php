<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model culturePnPsu\reserveCar\models\ReserveCarUse */

$this->title = $model->reserve_car_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('reserve', 'Reserve Car Uses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class='box box-info'>
    <div class='box-header'>
        <h3 class='box-title'><?= Html::encode($this->title) ?></h3>
    </div><!--box-header -->

    <div class='box-body pad'>
        <div class="reserve-car-use-view">

            <!--<h1><?= Html::encode($this->title) ?></h1>-->

            <p>
                <?= Html::a(Yii::t('reserve', 'Update'), ['update', 'id' => $model->reserve_car_id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a(Yii::t('reserve', 'Delete'), ['delete', 'id' => $model->reserve_car_id], [
                'class' => 'btn btn-danger',
                'data' => [
                'confirm' => Yii::t('reserve', 'Are you sure you want to delete this item?'),
                'method' => 'post',
                ],
                ]) ?>
            </p>

            <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                        'reserve_car_id',
            'reserve_car_oil_id',
            'liters_num',
            'amount',
            'returned_date',
            ],
            ]) ?>

        </div>
    </div><!--box-body pad-->
</div><!--box box-info-->
