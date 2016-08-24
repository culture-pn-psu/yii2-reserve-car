<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\reserveCar\models\ReserveCarPlacesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('reserve', 'Reserve Car Places');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class='box box-info'>
    <div class='box-header'>
        <h3 class='box-title'><?= Html::encode($this->title) ?></h3>
    </div><!--box-header -->

    <div class='box-body pad'>
        <div class="reserve-car-places-index">

            <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>
            <p>
                <?= Html::a(Yii::t('reserve', 'Create Reserve Car Places'), ['create'], ['class' => 'btn btn-success']) ?>
            </p>
            <?php Pjax::begin(); ?>                            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    //'id',
                    'title',
                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]);
            ?>
            <?php Pjax::end(); ?>        
        </div>
    </div><!--box-body pad-->
</div><!--box box-info-->
