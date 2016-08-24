<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\reserveCar\models\ReserveCarPlaces */

$this->title = Yii::t('reserve', 'Create Reserve Car Places');
$this->params['breadcrumbs'][] = ['label' => Yii::t('reserve', 'Reserve Car Places'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class='box box-info'>
    <div class='box-header'>
        <h3 class='box-title'><?= Html::encode($this->title) ?></h3>
    </div><!--box-header -->

    <div class='box-body pad'>
        <div class="reserve-car-places-create">

            <!--<h1><?= Html::encode($this->title) ?></h1>-->

            <?= $this->render('_form', [
            'model' => $model,
            ]) ?>

        </div>
    </div><!--box-body pad-->
</div><!--box box-info-->
