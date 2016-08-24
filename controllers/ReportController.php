<?php

namespace backend\modules\reserveCar\controllers;

use Yii;
use backend\modules\reserveCar\models\ReserveCarReport;
use backend\modules\reserveCar\models\ReserveCarReportSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\modules\reserveCar\models\ReserveCarUse;
use backend\modules\reserveCar\models\ReserveCarOil;

/**
 * ReportController implements the CRUD actions for ReserveCarReport model.
 */
class ReportController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all ReserveCarReport models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new ReserveCarReportSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ReserveCarReport model.
     * @param integer $month
     * @param string $year
     * @return mixed
     */
    public function actionView($month, $year) {
        $model = $this->findModel($month, $year);
        $modelOil = ReserveCarOil::find()->all();
        return $this->render('view', [
                    'model' => $model,
                    'newData' => $model->data,
                    'modelOil' => $modelOil,
                    'month' => $model->month,
                    'year' => $model->year
        ]);
    }

    /**
     * Creates a new ReserveCarReport model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new ReserveCarReport();

        if ($model->load(Yii::$app->request->post())) {

            $model->year = $model->year - 543;
            $model->created_by = Yii::$app->user->id;
            $del = ReserveCarReport::findOne(['month' => $model->month, 'year' => $model->year]);
            if ($del)
                $del->delete();

            $model->data = $this->getData($model->month, $model->year);
            if ($model->save()) {
                return $this->redirect(['view', 'month' => $model->month, 'year' => $model->year]);
            } else {
                print_r($model->getErrors());
            }
        }
        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing ReserveCarReport model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $month
     * @param string $year
     * @return mixed
     */
    public function actionUpdate($month, $year) {
        $model = $this->findModel($month, $year);
        if ($model->load(Yii::$app->request->post())) {

            $model->year = $model->year - 543;
            $model->created_by = Yii::$app->user->id;            

            $model->data = $this->getData($model->month, $model->year);
            if ($model->save()) {
                return $this->redirect(['view', 'month' => $model->month, 'year' => $model->year]);
            }
        }
        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ReserveCarReport model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $month
     * @param string $year
     * @return mixed
     */
    public function actionDelete($month, $year) {
        $this->findModel($month, $year)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ReserveCarReport model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $month
     * @param string $year
     * @return ReserveCarReport the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($month, $year) {
        if (($model = ReserveCarReport::findOne(['month' => $month, 'year' => $year])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * 
     * @param type $monthSelect
     * @param type $year
     * @return type
     */
    public function getData($monthSelect, $year = null) {
        $year = isset($year) ? $year : date('Y');
        $modelOil = ReserveCarOil::find()->all();
        $modelUse = ReserveCarUse::find()
                ->joinWith('reserveCar')
                ->select([
                    'm' => 'MONTH(reserve_car_use.returned_date)',
                    'sum_amount' => 'sum(reserve_car_use.amount)',
                    'reserve_car_use.reserve_car_oil_id'
                        //'reserve_car_use.*'
                ])
                ->where([
                    'YEAR(reserve_car_use.returned_date)' => $year,
                    'reserve_car.status' => 5
                    ])
                ->andWhere("MONTH(reserve_car_use.returned_date) BETWEEN 1 AND {$monthSelect}")
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

        return $newData;
    }

}
