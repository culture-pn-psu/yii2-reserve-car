<?php

namespace culturePnPsu\reserveCar\models;

use Yii;
use backend\models\Month;
use yii\helpers\ArrayHelper;
use wowkaster\serializeAttributes\SerializeAttributesBehavior;
use yii\behaviors\TimestampBehavior;
use common\models\User;

/**
 * This is the model class for table "reserve_car_report".
 *
 * @property integer $month
 * @property string $year
 * @property string $comment
 * @property string $data
 * @property integer $created_at
 * @property integer $created_by
 * @property integer $updated_at
 * @property integer $updated_by
 */
class ReserveCarReport extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'reserve_car_report';
    }

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            [
                'class' => SerializeAttributesBehavior::className(),
                'convertAttr' => ['data' => 'serialize']
            ],
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at'
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['month', 'year'], 'required'],
            [['month', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['year'], 'safe'],
            [['comment'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'month' => Yii::t('reserve', 'ประจำเดือน'),
            'year' => Yii::t('reserve', 'ประจำปี'),
            'comment' => Yii::t('reserve', 'หมายเหตุ'),
            'data' => Yii::t('reserve', 'ข้อมูลทั้งหมด'),
            'created_at' => Yii::t('reserve', 'สร้างเมื่อ'),
            'created_by' => Yii::t('reserve', 'สร้างโดย'),
            'updated_at' => Yii::t('reserve', 'ปรับปรุงเมื่อ'),
            'updated_by' => Yii::t('reserve', 'ปรับปรุงโดย'),
        ];
    }

    public static function getYear() {
        $current_year = date('Y');
        $to_year = date('Y', strtotime('-5 years'));
        $current_year_th = $current_year + 543;
        $to_year_th = $to_year + 543;
        return array_combine(range($to_year, $current_year), range($to_year_th, $current_year_th));
    }

    public function getMonthLabel() {
        return (isset($this->month)) ? ArrayHelper::getValue(Month::getLabel(), $this->month) : null;
    }

    public $year_th;

    public static function getYears() {
        $model = self::find()->select(['year', '(year+543) as year_th'])->distinct('year')->all();
        return ArrayHelper::map($model, 'year', 'year_th');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy() {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }
    
    
    
    public function getYearLabel() {
        return $this->year ? $this->year + 543 : null;
    }

}
