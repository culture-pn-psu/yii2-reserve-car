<?php

namespace culturePnPsu\reserveCar\models;

use Yii;
use backend\models\LocalProvince;
use backend\models\LocalAmphur;
/**
 * This is the model class for table "reserve_car_goto".
 *
 * @property integer $reserve_car_id
 * @property integer $local_province_id
 * @property integer $local_amphur_id
 *
 * @property LocalAmphur $localAmphur
 * @property LocalProvince $localProvince
 * @property ReserveCar $reserveCar
 */
class ReserveCarGoto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reserve_car_goto';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'local_province_id', 'local_amphur_id'], 'required'],
            [['reserve_car_id', 'local_province_id', 'local_amphur_id'], 'integer'],
            [['local_amphur_id'], 'exist', 'skipOnError' => true, 'targetClass' => LocalAmphur::className(), 'targetAttribute' => ['local_amphur_id' => 'id']],
            [['local_province_id'], 'exist', 'skipOnError' => true, 'targetClass' => LocalProvince::className(), 'targetAttribute' => ['local_province_id' => 'id']],
            [['reserve_car_id'], 'exist', 'skipOnError' => true, 'targetClass' => ReserveCar::className(), 'targetAttribute' => ['reserve_car_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'reserve_car_id' => Yii::t('reserve', 'Reserve Car ID'),
            'local_province_id' => Yii::t('reserve', 'Local Province ID'),
            'local_amphur_id' => Yii::t('reserve', 'Local Amphur ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocalAmphur()
    {
        return $this->hasOne(LocalAmphur::className(), ['id' => 'local_amphur_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocalProvince()
    {
        return $this->hasOne(LocalProvince::className(), ['id' => 'local_province_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReserveCar()
    {
        return $this->hasOne(ReserveCar::className(), ['id' => 'reserve_car_id']);
    }
    
    public static function deleteByIDs($id) {
        //print_r($id);
        $model = self::deleteAll(['reserve_car_id' => $id]);
        //return $model->deleteAll();
    }
}
