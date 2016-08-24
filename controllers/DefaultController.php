<?php

namespace culturePnPsu\reserveCar\controllers;

use Yii;
use culturePnPsu\reserveCar\models\ReserveCar;
use culturePnPsu\reserveCar\models\ReserveCarSearch;
use culturePnPsu\reserveCar\models\ReserveCarDraftSearch;
use culturePnPsu\reserveCar\models\ReserveCarGoto;
use culturePnPsu\reserveCar\models\ReserveCarResultSearch;
use culturePnPsu\reserveCar\models\ReserveCarOfferSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DefaultController implements the CRUD actions for ReserveCar model.
 */
class DefaultController extends Controller {

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
        $searchModel = new ReserveCarSearch();
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
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ReserveCar model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new ReserveCar();
        $modelGoto = [new ReserveCarGoto()];

        if ($model->load(Yii::$app->request->post())) {
            $post = Yii::$app->request->post();
            //print_r($post);
            //exit();            
            //$model->created_at = time();
            $model->created_by = Yii::$app->user->id;
            $model->status = 0;           
            
            if(!Yii::$app->user->can('staffFinance')){
                $model->reserved_by = Yii::$app->user->id;
            }

            $transaction = \Yii::$app->db->beginTransaction();
            try {
                if ($flag = $model->save(false)) {

                    ReserveCarGoto::deleteByIDs($model->id);
                    foreach ($post['ReserveCarGoto'] as $key => $val) {
                        $goto = new ReserveCarGoto();
                        $goto->reserve_car_id = $model->id;
                        $goto->local_province_id = $val['local_province_id'];
                        $goto->local_amphur_id = $val['local_amphur_id'];

                        if (($flag = $goto->save(false)) === false) {
                            $transaction->rollBack();
                            break;
                        }
                    }
                }
                if ($flag) {
                    $transaction->commit();
                    if (isset($post['save'])) {
                        return $this->redirect(['update', 'id' => $model->id]);
                    } else if (isset($post['send'])) {
                        return $this->redirect(['confirm', 'id' => $model->id]);
                    }
                }
            } catch (Exception $e) {
                $transaction->rollBack();
            }
        }

        return $this->render('create', [
                    'model' => $model,
                    'modelGoto' => $modelGoto
        ]);
    }

    /**
     * Updates an existing ReserveCar model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $modelGoto = $model->reserveCarGotos ? $model->reserveCarGotos : [new ReserveCarGoto()];

        if ($model->load(Yii::$app->request->post())) {
            $post = Yii::$app->request->post();
            //print_r($post);
            //exit();            

            if(!Yii::$app->user->can('staffFinance')){
                $model->reserved_by = Yii::$app->user->id;
            }
            
            $transaction = \Yii::$app->db->beginTransaction();
            try {
                if ($flag = $model->save(false)) {

                    ReserveCarGoto::deleteByIDs($model->id);
                    foreach ($post['ReserveCarGoto'] as $key => $val) {
                        $goto = new ReserveCarGoto();
                        $goto->reserve_car_id = $model->id;
                        $goto->local_province_id = $val['local_province_id'];
                        $goto->local_amphur_id = $val['local_amphur_id'];

                        if (($flag = $goto->save(false)) === false) {
                            $transaction->rollBack();
                            break;
                        }
                    }
                }
                if ($flag) {
                    $transaction->commit();
                    if (isset($post['save'])) {
                        return $this->redirect(['update', 'id' => $model->id]);
                    } else if (isset($post['send'])) {
                        return $this->redirect(['confirm', 'id' => $model->id]);
                    }
                }
            } catch (Exception $e) {
                $transaction->rollBack();
            }
        }
        return $this->render('update', [
                    'model' => $model,
                    'modelGoto' => $modelGoto
        ]);
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

    #################################

    public function actionDraft() {
        $searchModel = new ReserveCarDraftSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('draft', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionResult() {
        $searchModel = new ReserveCarResultSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionOffer() {
        $searchModel = new ReserveCarOfferSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    ################################################

    public function actionConfirm($id) {
       


        $model = $this->findModel($id);
        
        if ($model->load(Yii::$app->request->post())){
            
            $post = Yii::$app->request->post();
            if (isset($post['send'])) {
                $model->status = 1;
                $model->reserved_at = time();
            }
            
            if($model->save()) {        
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('confirm', [
                        'model' => $model,
            ]);
        }
    }
    
    /**
     * 
     * @param type $modelName
     * @param type $post
     * @param type $id
     * @param type $title
     * @return type
     */
    public function chkTb($modelName, $post, $id, $title) {
        


        if (isset($val[$id])) {
            $modelPost = new $modelName();
            $model = $modelName::findOne(['id' => $val[$id]]);
//            print_r($model);
//            exit();
            if ($model === NULL) {
                //$this->pr($model);
                $model = new $modelName();
                //$model->id = $val[$id];
                //$val[$title]=$val[$id];
//                echo $modelName;
//                exit();
                switch ($modelName) {
                    case 'culturePnPsu\reserveCar\models\ReserveCarPlaces':
                        $model->id = $ch_id;
                        $model->title = $ch_title;
                        //$model->brand = $val['material_brand'];
                        $model->status = 1;
                        $model->created_at = time();
                        $model->created_by = Yii::$app->user->id;
                        break;
                }
                if (!$model->save()) {
                    print_r($model->getErrors());
                }
                return $model->id;
            } else {
                return $model->id;
            }
        }
    }

}
