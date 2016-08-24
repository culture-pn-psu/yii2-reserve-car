<?php

namespace backend\modules\reserveCar\models;

use Yii;

/**
 * This is the model class for table "reserve_car_use".
 *
 * @property integer $reserve_car_id
 * @property integer $reserve_car_oil_id
 * @property double $liters_num
 * @property double $amount
 * @property string $returned_date
 *
 * @property ReserveCar $reserveCar
 * @property ReserveCarOil $reserveCarOil
 */
class ReserveCarUse extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reserve_car_use';
    }

    public $m;
    public $sum_amount;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['reserve_car_oil_id'], 'integer'],
            [['liters_num', 'amount'], 'number'],
            [['returned_date'], 'safe'],
            [['reserve_car_id'], 'exist', 'skipOnError' => true, 'targetClass' => ReserveCar::className(), 'targetAttribute' => ['reserve_car_id' => 'id']],
            [['reserve_car_oil_id'], 'exist', 'skipOnError' => true, 'targetClass' => ReserveCarOil::className(), 'targetAttribute' => ['reserve_car_oil_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'reserve_car_id' => Yii::t('reserve', 'Reserve Car ID'),
            'reserve_car_oil_id' => Yii::t('reserve', 'ประเภทน้ำมัน'),
            'liters_num' => Yii::t('reserve', 'จำนวน (ลิตร)'),
            'amount' => Yii::t('reserve', 'จำนวนเงิน'),
            'returned_date' => Yii::t('reserve', 'กลับมาเมื่อวัน/เวลา'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReserveCar()
    {
        return $this->hasOne(ReserveCar::className(), ['id' => 'reserve_car_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReserveCarOil()
    {
        return $this->hasOne(ReserveCarOil::className(), ['id' => 'reserve_car_oil_id']);
    }
}
