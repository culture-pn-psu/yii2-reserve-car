<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
//use culturePnPsu\reserveCar\models\FormSearch;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('reserve', 'รายงานการใช้พลังงาน');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class='box box-info'>
    <div class='box-header hidden-print'>
        <h3 class='box-title'><?= Html::encode($this->title) ?></h3>
        <div class="box-tools"> 
            <?= Html::a('<i class="fa fa-print"></i>', '#', ['class' => 'btn btn-primary btn-sm', 'onclick' => 'window.print();']) ?>
        </div>
    </div><!--box-header -->

    <div class='box-body pad'>
        
        <?= Html::tag('h3', 'แบบฟอร์มรายงานการใช้พลังงาน', ['class' => 'text-center']) ?>
        <?= Html::tag('h4', 'ประจำปีงบประมาณ ' . ($year+543), ['class' => 'text-center']) ?>
        <?= Html::tag('p', 'ข้อมูลการใช้เชื้อเพลิงสำหรับรถยนต์และรถจักรยายนตร์') ?>


        <table class="table table-bordered">
            <thead>
                <tr>
                    <th rowspan="2" class="text-center" style="vertical-align: middle;">เดือน/ปี</th>
                    <th colspan="<?= count($modelOil) ?>" class="text-center" style="vertical-align: middle;">ปริมาณการใช้เชื้อเพลิง</th>
                    <th rowspan="2" class="text-center" style="vertical-align: middle;">จำนวนเงิน(บาท)</th>
                </tr>
                <tr>
                    <?php foreach ($modelOil as $oil): ?>
                        <th class="text-center"><?= $oil->title ?></th>
                    <?php endforeach; ?> 

                </tr>
            </thead>
            <tbody>
                <?php
                $rowTotal = 0;
                $total = [];
                foreach ($newData as $data):
                    $rowTotal = 0;
                    ?>
                    <tr>
                        <td><?= $data['month'] ?></td>
                        <?php
                        foreach ($modelOil as $oil):
                            $rowTotal +=$data[$oil->id];
                            if (!isset($total[$oil->id]))
                                $total[$oil->id] = 0;
                            $total[$oil->id] += $data[$oil->id];
                            ?>
                        <td class="text-right"><?= number_format($data[$oil->id], 2,'.',',') ?></td>

                        <?php endforeach; ?> 
                        <td class="text-right"><?= number_format($rowTotal, 2,'.',',') ?></td>
                    </tr>
                <?php endforeach; ?> 

            </tbody>
            <tfoot>
                <tr>
                    <td class="text-right">รวม</td>
                    <?php foreach ($modelOil as $oil): ?>
                        <td class="text-right"><?= number_format($total[$oil->id], 2,'.',',') ?></td>

                    <?php endforeach; 
                    $total = array_sum($total);
                    ?> 
                    <td class="text-right"><?= number_format($total, 2,'.',',') ?></td>
                </tr>
                <tr>
                    <td class="text-right" colspan="<?= count($modelOil)+2 ?>"><?=Yii::$app->number->wordThai($total)?></td>
                    
                </tr>
            </tfoot>
        </table>
        <br />
        <div class="row">
            <div class="col-xs-4 col-sm-4">
                <label>ปัจจัย/สาเหตุ ของการใช้พลังงานเพิ่มขึ้น-ลดลง</label>
            </div>
            <div class="col-xs-8 col-sm-8">
                <?=$model->comment?>
            </div>
        </div>




    </div><!--box-body pad-->
</div><!--box box-info-->
