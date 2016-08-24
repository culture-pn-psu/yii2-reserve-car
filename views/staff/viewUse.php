<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

if($modelUse):
?>

<div class="row">
    <div class="col-sm-10 col-sm-offset-1">
        <?=Html::tag('h3','การใช้น้ำมัน')?>
        <?=
        DetailView::widget([
            'model' => $modelUse,
            'options' => ['class' => 'table'],
            'template' => '<tr><th width="30%" class="text-right">{label}</th><td>{value}</td></tr>',
            'attributes' => [
                'reserve_car_oil_id',
                'liters_num',
                'amount',
                'returned_date',
            ],
        ])
        ?>
    </div>


</div>
<?php endif;?>

