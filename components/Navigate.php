<?php

namespace culturePnPsu\reserveCar\components;

//use yii\base\Model;
use Yii;

/**
 * Description of navigate
 *
 * @author madone
 */
class Navigate extends \firdows\menu\models\Navigate {

    
    public function getCount($router) {
        $count = '';
        switch ($router) {
        
           case '/reserve-car/default/index':
                $searchModel = new \culturePnPsu\reserveCar\models\ReserveCarSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $count = $dataProvider->getTotalCount();
                $count = $count ? '<span> (' . $count . ')</span>' : '';
                break;

            case '/reserve-car/default/draft':
                $searchModel = new \culturePnPsu\reserveCar\models\ReserveCarDraftSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $count = $dataProvider->getTotalCount();
                $count = $count ? '<span class="text-red"> (' . $count . ')</span>' : '';
                break;

            case '/reserve-car/default/offer':
                $searchModel = new \culturePnPsu\reserveCar\models\ReserveCarOfferSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $count = $dataProvider->getTotalCount();
                $count = $count ? '<span> (' . $count . ')</span>' : '';
                break;

            case '/reserve-car/default/result':
                $searchModel = new \culturePnPsu\reserveCar\models\ReserveCarResultSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $count = $dataProvider->getTotalCount();
                $count = $count ? '<span> (' . $count . ')</span>' : '';
                break;

            case '/reserve-car/staff/index':
                $searchModel = new \culturePnPsu\reserveCar\models\ReserveCarStaffSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $count = $dataProvider->getTotalCount();
                $count = $count ? '<small class="label pull-right label-info">' . $count . '</small>' : '';
                break;

            case '/reserve-car/staff/consider':
                $searchModel = new \culturePnPsu\reserveCar\models\ReserveStaffConsiderSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $count = $dataProvider->getTotalCount();
                $count = $count ? '<span> (' . $count . ')</span>' : '';
                break;

            case '/reserve-car/staff/comeback':
                $searchModel = new \culturePnPsu\reserveCar\models\ReserveStaffComebackSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $count = $dataProvider->getTotalCount();
                $count = $count ? '<span> (' . $count . ')</span>' : '';
                break;

            case '/reserve-car/staff/result':
                $searchModel = new \culturePnPsu\reserveCar\models\ReserveStaffResultSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $count = $dataProvider->getTotalCount();
                $count = $count ? '<span> (' . $count . ')</span>' : '';
                break;          
        }
        $this->count = $count;
    }

}
