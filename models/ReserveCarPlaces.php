<?php

namespace culturePnPsu\reserveCar\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "reserve_car_places".
 *
 * @property integer $id
 * @property string $title
 *
 * @property ReserveCar[] $reserveCars
 */
class ReserveCarPlaces extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'reserve_car_places';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['title'], 'required'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('reserve', 'ID'),
            'title' => Yii::t('reserve', 'สถานที่'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReserveCars() {
        return $this->hasMany(ReserveCar::className(), ['reserve_car_places_id' => 'id']);
    }

    ##################################

    public static function getList() {
        return ArrayHelper::map(self::find()->all(), 'id', 'title');
    }

}
