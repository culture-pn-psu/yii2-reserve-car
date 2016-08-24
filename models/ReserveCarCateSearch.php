<?php

namespace culturePnPsu\reserveCar\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use culturePnPsu\reserveCar\models\ReserveCarCate;

/**
 * ReserveCarCateSearch represents the model behind the search form about `culturePnPsu\reserveCar\models\ReserveCarCate`.
 */
class ReserveCarCateSearch extends ReserveCarCate
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'seat_num'], 'integer'],
            [['title'], 'safe'],
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
        $query = ReserveCarCate::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'seat_num' => $this->seat_num,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title]);

        return $dataProvider;
    }
}
