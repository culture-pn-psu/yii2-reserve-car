<?php

namespace backend\modules\reserveCar\controllers;

use Yii;
use backend\modules\reserveCar\models\ReserveCar;
use backend\modules\reserveCar\models\ReserveCarStaffSearch;
use backend\modules\reserveCar\models\ReserveStaffComebackSearch;
use backend\modules\reserveCar\models\ReserveStaffConsiderSearch;
use backend\modules\reserveCar\models\ReserveStaffResultSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\modules\reserveCar\models\ReserveCarUse;

/**
 * StaffController implements the CRUD actions for ReserveCar model.
 */
class StaffController extends Controller {

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
     * Lists all ReserveCar models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new ReserveCarStaffSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ReserveCar model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {

        $model = $this->findModel($id);
        $modelUse = $model->reserveCarUse ? $model->reserveCarUse : null;

        if ($model->status == 1) {
            $model->status = 2;
            $model->save(false);
        }


        if ($model->load(Yii::$app->request->post())) {
            $post = Yii::$app->request->post();

            if (isset($post['btnReserv'])) {
                $model->status = 3;
                $modelUser = new ReserveCarUse();
                $modelUser->reserve_car_id = $model->id;
                $modelUser->save(false);
            } elseif (isset($post['btnBusy'])) {
                $model->status = 4;
            }

            if ($model->save()) {
                return $this->redirect(['result', 'id' => $model->id]);
            }
        }



        return $this->render('view', [
                    'model' => $model,
                    'modelUse' => $modelUse,
        ]);
    }

    /**
     * Displays a single ReserveCar model.
     * @param integer $id
     * @return mixed
     */
    public function actionUse($id) {

        $model = $this->findModel($id);
        $modelUse = $model->reserveCarUse;



        if ($model->load(Yii::$app->request->post()) && $modelUse->load(Yii::$app->request->post())) {
            $post = Yii::$app->request->post();

            $model->status = 5;

            if ($model->save() && $modelUse->save()) {
                return $this->redirect(['result']);
            } else {
                print_r($model->getErrors());
                print_r($modelUse->getErrors());
            }
        }
//        else{
//            print_r($modelUse->validate());
//        }



        return $this->render('use', [
                    'model' => $model,
                    'modelUse' => $modelUse,
        ]);
    }

    /**
     * Creates a new ReserveCar model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new ReserveCar();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ReserveCar model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ReserveCar model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ReserveCar model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ReserveCar the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = ReserveCar::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    ####################################

    public function actionComeback() {
        $searchModel = new ReserveStaffComebackSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionConsider() {
        $searchModel = new ReserveStaffConsiderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionResult() {
        $searchModel = new ReserveStaffResultSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

}
