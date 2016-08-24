<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model culturePnPsu\reserveCar\models\ReserveCar */

$this->title = $model->subject;
$this->params['breadcrumbs'][] = ['label' => Yii::t('reserve', 'รายการขอใช้รถ'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class='box box-info'>
    <div class='box-header hidden-print'>
        <h3 class='box-title'><?= Html::encode($this->title) ?></h3>
        <div class="box-tools">           
            <?= Html::a('<i class="fa fa-print"></i>', '#', ['class' => 'btn btn-primary btn-sm', 'onclick' => 'window.print();']) ?>
        </div>
    </div><!--box-header -->

    <?=$this->render('_view',['model'=>$model]) ?>
    
</div><!--box box-info-->
