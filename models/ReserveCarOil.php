<?php

namespace backend\modules\reserveCar\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "reserve_car_oil".
 *
 * @property integer $id
 * @property string $title
 *
 * @property ReserveCarUse[] $reserveCarUses
 */
class ReserveCarOil extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reserve_car_oil';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('reserve', 'ID'),
            'title' => Yii::t('reserve', 'ประเภทน้ำมันเชื้อเพลิง'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReserveCarUses()
    {
        return $this->hasMany(ReserveCarUse::className(), ['reserve_car_oil_id' => 'id']);
    }
    
    
    public static function getList(){
        return ArrayHelper::map(self::find()->all(),'id','title');
    }
}
