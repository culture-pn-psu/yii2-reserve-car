<?php

namespace backend\modules\reserveCar\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\reserveCar\models\ReserveCarReport;

/**
 * ReserveCarReportSearch represents the model behind the search form about `backend\modules\reserveCar\models\ReserveCarReport`.
 */
class ReserveCarReportSearch extends ReserveCarReport
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['month', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['year', 'comment', 'data'], 'safe'],
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
        $query = ReserveCarReport::find();

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
            'month' => $this->month,
            'year' => $this->year,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'comment', $this->comment])
            ->andFilterWhere(['like', 'data', $this->data]);

        return $dataProvider;
    }
}
