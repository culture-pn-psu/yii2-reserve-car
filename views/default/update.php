<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\reserveCar\models\ReserveCar */

$this->title = Yii::t('reserve', 'Update {modelClass}: ', [
            'modelClass' => 'Reserve Car',
        ]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('reserve', 'Reserve Cars'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('reserve', 'Update');
?>
<div class='box box-info'>
    <!--    <div class='box-header'>
            <h3 class='box-title'><?= Html::encode($this->title) ?></h3>
        </div>box-header -->

    <div class='box-body pad'>
        <div class="reserve-car-update">

            <?=
            $this->render('_form', [
                'model' => $model,
                'modelGoto'=>$modelGoto
            ])
            ?>

        </div>
    </div><!--box-body pad-->
</div><!--box box-info-->
