<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\reserveCar\models\ReserveCar */

$this->title = $model->subject;
$this->params['breadcrumbs'][] = ['label' => Yii::t('reserve', 'Reserve Cars'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class='box box-info'>
    
    <div class='box-header hidden-print'>
        <h3 class='box-title'><?= Html::encode($this->title) ?></h3>
        <div class="box-tools">           
            <?= Html::a('<i class="fa fa-print"></i>', '#', ['class' => 'btn btn-primary btn-sm', 'onclick' => 'window.print();']) ?>
        </div>
    </div><!--box-header -->

    <?= $this->render('../default/_view', ['model' => $model]) ?>
    <?= $this->render('viewUse', ['modelUse' => $modelUse]) ?>
    <?= $this->render('viewComment', ['model' => $model]) ?>
</div><!--box box-info-->

