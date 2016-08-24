<?php

namespace backend\modules\reserveCar\models;

use Yii;
use common\models\User;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "reserve_car".
 *
 * @property integer $id
 * @property string $subject
 * @property integer $status
 * @property string $date_start
 * @property string $time_start
 * @property string $date_end
 * @property string $time_end
 * @property integer $reserve_car_places_id
 * @property integer $reserve_car_cate_id
 * @property integer $created_at
 * @property integer $reserved_at
 * @property integer $reserved_by
 * @property string $passenger
 * @property string $tel
 * @property string $note
 *
 * @property ReserveCarCate $reserveCarCate
 * @property User $reservedBy
 * @property ReserveCarPlaces $reserveCarPlaces
 * @property ReserveCarUse $reserveCarUse
 * @property ResevreCarGoto[] $resevreCarGotos
 */
class ReserveCar extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'reserve_car';
    }

    public function behaviors() {
        return [
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
            [['subject'], 'required'],
            [['status', 'reserve_car_places_id', 'reserve_car_cate_id', 'created_at','updated_at', 'reserved_at', 'reserved_by', 'created_by'], 'integer'],
            [['date_start', 'time_start', 'date_end', 'time_end'], 'safe'],
            [['passenger'], 'number'],
            [['subject', 'note'], 'string', 'max' => 255],
            [['tel'], 'string', 'max' => 30],
            [['reserve_car_cate_id'], 'exist', 'skipOnError' => true, 'targetClass' => ReserveCarCate::className(), 'targetAttribute' => ['reserve_car_cate_id' => 'id']],
            [['reserved_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['reserved_by' => 'id']],
            [['reserve_car_places_id'], 'exist', 'skipOnError' => true, 'targetClass' => ReserveCarPlaces::className(), 'targetAttribute' => ['reserve_car_places_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('reserve', 'ID'),
            'subject' => Yii::t('reserve', 'เรื่อง'),
            'status' => Yii::t('reserve', 'สถานะ'),
            'date_start' => Yii::t('reserve', 'วันที่เดินทาง'),
            'time_start' => Yii::t('reserve', 'เวลาที่เดินทาง'),
            'date_end' => Yii::t('reserve', 'วันที่กลับ'),
            'time_end' => Yii::t('reserve', 'เวลาที่กลับ'),
            'reserve_car_places_id' => Yii::t('reserve', 'สถานที่ที่ให้รถไปรับ'),
            'reserve_car_cate_id' => Yii::t('reserve', 'ประเภทรถ'),
            'created_at' => Yii::t('reserve', 'สร้างเมื่อ'),
            'reserved_at' => Yii::t('reserve', 'จองเมื่อ'),
            'created_by' => Yii::t('reserve', 'สร้างโดย'),
            'reserved_by' => Yii::t('reserve', 'ผู้ขอใช้รถ'),
            'passenger' => Yii::t('reserve', 'ผู้โดยสาร'),
            'tel' => Yii::t('reserve', 'เบอร์โทรศัพท์'),
            'note' => Yii::t('reserve', 'หมายเหตุ'),
            'gotos' => Yii::t('reserve', 'ไปราชการที่'),
        ];
    }

    public function attributeHints() {
        return [
            'date_start' => Yii::t('reserve', 'กรุณาเลือกวันที่เดินทางได้ไม่เกิน 30 วัน'),
            'date_end' => Yii::t('reserve', 'วันที่เดินทางกลับ'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReserveCarCate() {
        return $this->hasOne(ReserveCarCate::className(), ['id' => 'reserve_car_cate_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReservedBy() {
        return $this->hasOne(User::className(), ['id' => 'reserved_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy() {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReserveCarPlaces() {
        return $this->hasOne(ReserveCarPlaces::className(), ['id' => 'reserve_car_places_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReserveCarUse() {
        return $this->hasOne(ReserveCarUse::className(), ['reserve_car_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReserveCarGotos() {
        return $this->hasMany(ReserveCarGoto::className(), ['reserve_car_id' => 'id']);
    }

    ######################################################

    public static function itemsAlias($key) {
        $items = [
            'status' => [
                0 => Yii::t('app', 'ร่าง'),
                1 => Yii::t('app', 'เสนอ'),
                2 => Yii::t('app', 'พิจารณา'),
                3 => Yii::t('app', 'จองแล้ว'),
                4 => Yii::t('app', 'รถไม่ว่าง'),
                5 => Yii::t('app', 'กลับมาแล้ว'),
                6 => Yii::t('app', 'ยกเลิก'),
            ],
        ];
        return ArrayHelper::getValue($items, $key, []);
    }

    public function getStatusLabel() {
        $status = ArrayHelper::getValue($this->getItemStatus(), $this->status);
        $status = ($this->status === NULL) ? ArrayHelper::getValue($this->getItemStatus(), 0) : $status;
        switch ($this->status) {
            case '0' :
            case NULL :
                $str = '<span class="label label-warning">' . $status . '</span>';
                break;

            case '1' :
                $str = '<span class="label label-info">' . $status . '</span>';
                break;

            case '2' :
                $str = '<span class="label label-info">' . $status . '</span>';
                break;

            case '3' :
                $str = '<span class="label label-primary">' . $status . '</span>';
                break;

            case '4' :
                $str = '<span class="label label-warning">' . $status . '</span>';
                break;

            //case '2' :
            case '5' :
                $str = '<span class="label label-success">' . $status . '</span>';
                break;

            case '6' :
                $str = '<span class="label label-drager">' . $status . '</span>';
                break;
            case '8' :
                $str = '<span class="label label-info">' . $status . '</span>';
                break;
            default :
                $str = $status;
                break;
        }

        return $str;
    }

    public static function getItemStatus() {
        return self::itemsAlias('status');
    }

    public function getDateTimeStart() {
        return $this->date_start . " " . $this->time_start;
    }

    public function getDateTimeEnd() {
        return $this->date_end . " " . $this->time_end;
    }

    public function getGotos() {
        //print_r($this->reserveCarGotos);        
        $model = $this->reserveCarGotos;
        $gotos = [];
        foreach ($model as $goto) {
            $str = '';
            $str .= ($goto->local_amphur_id) ? 'อ.' . $goto->localAmphur->name : '';
            $str .= ($goto->local_province_id) ? 'จ.' . $goto->localProvince->name : '';

            $gotos[] = $str ? $str : '';
        }
        $gotos = array_filter($gotos);
        return $gotos ? @implode('<br />', $gotos) : null;
    }

    public static function getPersonAll() {
        $model = \backend\modules\person\models\Person::find()
                ->joinWith('user')
                ->all();
        return ArrayHelper::map($model, 'user.id', 'fullname');
    }

}
