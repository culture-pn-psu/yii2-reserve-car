<?php

namespace backend\modules\reserveCar\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "reserve_car_cate".
 *
 * @property integer $id
 * @property string $title
 * @property integer $seat_num
 *
 * @property ReserveCar[] $reserveCars
 */
class ReserveCarCate extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'reserve_car_cate';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['seat_num'], 'integer'],
            [['title'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('reserve', 'ID'),
            'title' => Yii::t('reserve', 'รถ'),
            'seat_num' => Yii::t('reserve', 'จำนวนที่นั่ง'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReserveCars() {
        return $this->hasMany(ReserveCar::className(), ['reserve_car_cate_id' => 'id']);
    }
    
    public function getTitleNum() {
        return $this->title.($this->seat_num?" ".$this->seat_num." ที่นั่ง":'');
    }

    
    public static function getList() {
        return ArrayHelper::map(self::find()->all(), 'id', 'titleNum');
    }

}
