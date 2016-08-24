<?php

namespace culturePnPsu\reserveCar\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use culturePnPsu\reserveCar\models\ReserveCar;

/**
 * ReserveCarStaffSearch represents the model behind the search form about `culturePnPsu\reserveCar\models\ReserveCar`.
 */
class ReserveStaffConsiderSearch extends ReserveCar
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'reserve_car_places_id', 'reserve_car_cate_id', 'created_at', 'reserved_at', 'reserved_by'], 'integer'],
            [['subject', 'date_start', 'time_start', 'date_end', 'time_end', 'tel', 'note'], 'safe'],
            [['passenger'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = ReserveCar::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

         $query->where(['status'=>2]);
        
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'date_start' => $this->date_start,
            'time_start' => $this->time_start,
            'date_end' => $this->date_end,
            'time_end' => $this->time_end,
            'reserve_car_places_id' => $this->reserve_car_places_id,
            'reserve_car_cate_id' => $this->reserve_car_cate_id,
            'created_at' => $this->created_at,
            'reserved_at' => $this->reserved_at,
            'reserved_by' => $this->reserved_by,
            'passenger' => $this->passenger,
        ]);

        $query->andFilterWhere(['like', 'subject', $this->subject])
            ->andFilterWhere(['like', 'tel', $this->tel])
            ->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }
}
