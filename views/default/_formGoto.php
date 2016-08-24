<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

use wbraganca\dynamicform\DynamicFormWidget;
use backend\models\LocalProvince;
use backend\models\LocalAmphur;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;

?>



<div class="row">
            <div class="col-sm-11 col-sm-offset-1">
                <label>ไปราชการที่</label>
                <div id="panel-option-values" class="panel panel-default">

                    <?php
                    DynamicFormWidget::begin([
                        'widgetContainer' => 'dynamicform_wrapper',
                        'widgetBody' => '.form-options-body',
                        'widgetItem' => '.form-options-item',
                        'min' => 1,
                        'insertButton' => '.add-item',
                        'deleteButton' => '.delete-item',
                        'model' => $modelGoto[0],
                        'formId' => 'dynamic-form',
                        'formFields' => [
                            //'reserve_car_id',
                            'local_province_id',
                            'local_amphur_id',
                        ],
                    ]);
                    ?>

                    <table class="table table-bordered table-striped margin-b-none table-responsive">
                        <thead>
                            <tr>
                                <th style="text-align: center" width="70" nowrap >
                                    <?= Yii::t('reserve', 'ลำดับที่'); ?>
                                </th>
                                <th class="required">
                                    <?= Yii::t('reserve', 'จังหวัด'); ?>
                                </th>
                                <th class="required text-nowrap" >
                                    <?= Yii::t('reserve', 'อำเภอ'); ?>
                                </th>

                                <th class="text-center text-nowrap" style="width: 30px;"></th>
                            </tr>

                        </thead>
                        <tbody class="form-options-body">
                            <?php foreach ($modelGoto as $i => $goto): ?>
                                <tr class="form-options-item">
                                    <td class="text-right number" >
                                        <?= ($i + 1) ?>                                
                                    </td>
                                    <td class="vcenter title">
                                        <?=
                                        $form->field($goto, "[{$i}]local_province_id")->dropdownList(LocalProvince::getList(), [
                                            'id' => "ddl-province{$i}",
                                            'prompt' => 'เลือกจังหวัด'
                                        ])->label(false);
                                        ?>
                                    </td>
                                    <td class="vcenter title">
                                        <?=
                                        $form->field($goto, "[{$i}]local_amphur_id")->widget(DepDrop::classname(), [
                                            'options' => ['id' => "ddl-amphur{$i}"],
                                            'data' => $goto->local_province_id ? LocalAmphur::getList($goto->local_province_id) : [],
                                            'pluginOptions' => [
                                                'depends' => ["ddl-province{$i}"],
                                                'placeholder' => 'เลือกอำเภอ...',
                                                'url' => Url::to(['/local/get-amphur'])
                                            ]
                                        ])->label(false);
                                        ?>
                                    </td>

                                    <td class="text-center vcenter">
                                        <button type="button" class="delete-item btn btn-danger btn-xs"><i class="fa fa-minus"></i></button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><button type="button" class="add-item btn btn-success btn-sm"><span class="fa fa-plus"></span> เพิ่ม</button></td>
                            </tr>
                        </tfoot>

                    </table>

                    <?php DynamicFormWidget::end(); ?>
                </div>
            </div>
        </div>


<?php
$js = '
    //alert(555);
jQuery(".dynamicform_wrapper").on("afterInsert", function(e, item) {
    bindNumber();
});

jQuery(".dynamicform_wrapper").on("afterDelete", function(e) {
    bindNumber();   
});


function bindNumber(){
    jQuery(".dynamicform_wrapper .number").each(function(index) {
        jQuery(this).html((index + 1));
        //alert(555);
    });
 }
';

$this->registerJs($js);
