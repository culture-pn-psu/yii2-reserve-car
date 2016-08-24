<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model culturePnPsu\reserveCar\models\ReserveCar */

$this->title = Yii::t('reserve', 'แบบฟอร์การขอใช้รถ');
$this->params['breadcrumbs'][] = ['label' => Yii::t('reserve', 'รายการขอใช้รถ'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class='box box-info'>
    <!--    <div class='box-header'>
            <h3 class='box-title'><?= Html::encode($this->title) ?></h3>
        </div>box-header -->

    <div class='box-body pad'>
        <div class="reserve-car-create">

            <?=
            $this->render('_form', [
                'model' => $model,
                'modelGoto' => $modelGoto
            ])
            ?>

        </div>
    </div><!--box-body pad-->
</div><!--box box-info-->
