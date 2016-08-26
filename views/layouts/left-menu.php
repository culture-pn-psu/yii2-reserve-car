<?php

use yii\helpers\Html;
use yii\helpers\BaseStringHelper;
use culturePnPsu\reserveCar\components\Navigate;

/* @var $this \yii\web\View */
/* @var $content string */

$controller = $this->context;
//$menus = $controller->module->menus;
//$route = $controller->route;
?>
<?php $this->beginContent('@app/views/layouts/main.php') ?>

<div class="row">
    <div class="col-md-3 hidden-print">

        <?= Html::a('<i class="fa fa-car"></i> ' . Yii::t('reserve', 'ขอใช้รถ'), ['/reserve-car/default/create'], ['class' => 'btn btn-primary btn-block margin-bottom']) ?>


        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">
                    <?= Yii::t('reserve', 'ระบบขอใช้รถ') ?>
                </h3>

                <div class="box-tools">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="box-body no-padding">

                <?php
                $nav = new Navigate();
                echo dmstr\widgets\Menu::widget([
                    'options' => ['class' => 'nav nav-pills nav-stacked'],
                    //'linkTemplate' =>'<a href="{url}">{icon} {label} {badge}</a>',
                    'items' => $nav->menu(16),
                ])
                ?>                 

            </div>
            <!-- /.box-body -->
        </div>

        <?php
        if (Yii::$app->user->can('staffFinance')
        ):
            ?>
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        สำหรับเจ้าหน้าที่
                    </h3>

                    <div class="box-tools">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body no-padding">

                    <?php
                    $nav = new Navigate();
                    echo dmstr\widgets\Menu::widget([
                        'options' => ['class' => 'nav nav-pills nav-stacked'],
                        //'linkTemplate' =>'<a href="{url}">{icon} {label} {badge}</a>',
                        'items' => $nav->menu(17),
                    ])
                    ?>                 

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /. box -->

            <div class="box box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        จัดการข้อมูลส่วนอื่นๆ
                    </h3>

                    <div class="box-tools">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body no-padding">

                    <?php
                    $menu = [];
                    $menu[] = [
                        'label' => 'จัดการประเภทรถ',
                        'url' => ['/reserve-car/car'],
                    ];
                    
                    $menu[] = [
                        'label' => 'จัดการประเภทน้ำมัน',
                        'url' => ['/reserve-car/oil'],
                    ];
                    
                    $menu[] = [
                        'label' => 'จัดการสถานที่',
                        'url' => ['/reserve-car/places'],
                    ];



                    $nav = new common\models\Navigate();
                    echo dmstr\widgets\Menu::widget([
                        'options' => ['class' => 'nav nav-pills nav-stacked'],
                        //'linkTemplate' =>'<a href="{url}">{icon} {label} {badge}</a>',
                        'items' => $menu,
                    ])
                    ?>                 

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /. box -->
        <?php endif; ?>

        <?php /* if (Yii::$app->user->can('headSupport')): ?>
          <div class="box box-solid">
          <div class="box-header with-border">
          <h3 class="box-title">
          สำหรับหัวหน้า
          </h3>

          <div class="box-tools">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
          </div>
          </div>
          <div class="box-body no-padding">

          <?php
          $nav = new common\models\Navigate();
          echo dmstr\widgets\Menu::widget([
          'options' => ['class' => 'nav nav-pills nav-stacked'],
          //'linkTemplate' =>'<a href="{url}">{icon} {label} {badge}</a>',
          'items' => $nav->menu(6),
          ])
          ?>

          </div>
          <!-- /.box-body -->
          </div>
          <!-- /. box -->
          <?php endif; ?>

          <?php if (Yii::$app->user->can('director')): ?>
          <div class="box box-solid">
          <div class="box-header with-border">
          <h3 class="box-title">
          สำหรับผู้บริหาร
          </h3>

          <div class="box-tools">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
          </div>
          </div>
          <div class="box-body no-padding">

          <?php
          $nav = new common\models\Navigate();
          echo dmstr\widgets\Menu::widget([
          'options' => ['class' => 'nav nav-pills nav-stacked'],
          //'linkTemplate' =>'<a href="{url}">{icon} {label} {badge}</a>',
          'items' => $nav->menu(7),
          ])
          ?>

          </div>
          <!-- /.box-body -->
          </div>
          <!-- /. box -->
          <?php endif; */ ?>
    </div>
    <!-- /.col -->


    <div class="col-md-9">
        <?= $content ?>
        <!-- /. box -->
    </div>
    <!-- /.col -->


</div>


<?php $this->endContent(); ?>
