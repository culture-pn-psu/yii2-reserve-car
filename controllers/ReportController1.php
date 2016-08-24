<?php

namespace culturePnPsu\reserveCar\controllers;

use Yii;
use culturePnPsu\reserveCar\models\ReserveCar;
use culturePnPsu\reserveCar\models\ReserveCarUse;
use culturePnPsu\reserveCar\models\ReserveCarOil;
use culturePnPsu\reserveCar\models\FormSearch;

class ReportController extends \yii\web\Controller {

    public function actionIndex() {


        $search = new FormSearch();
        $post = Yii::$app->request->post();
        $year = date('Y');
        if (isset($post['FormSearch']['year'])) {
            $year = $post['FormSearch']['year'];            
        }
            $search->year = $year;
        

        $modelOil = ReserveCarOil::find()->all();
        $modelUse = ReserveCarUse::find()
                ->joinWith('reserveCar')
                ->select([
                    'm' => 'MONTH(reserve_car_use.returned_date)',
                    'sum_amount' => 'sum(reserve_car_use.amount)',
                    'reserve_car_use.reserve_car_oil_id'
                        //'reserve_car_use.*'
                ])
                ->where(['YEAR(reserve_car_use.returned_date)' => $year, 'reserve_car.status' => 5])
                ->groupBy('reserve_car_use.reserve_car_oil_id')
                ->all();

        $newData = [];
        $month = \backend\models\Month::getLabel();

        foreach ($month as $k => $v) {
            $newData[$k]['month'] = $v;
            foreach ($modelOil as $oil) {
                $newData[$k][$oil->id] = 0;
            }
        }

        foreach ($modelUse as $model) {
            $newData[$model->m][$model->reserve_car_oil_id] = $model->sum_amount;
        }


        return $this->render('index', [
                    //'model' => $model,
                    'newData' => $newData,
                    'modelOil' => $modelOil,
                    'month' => $month,
                    'search' => $search,
                    'year'=>$year
        ]);
    }

}
