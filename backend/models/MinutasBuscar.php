<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Minutas;

/**
 * MinutasBuscar represents the model behind the search form of `backend\models\Minutas`.
 */
class MinutasBuscar extends Minutas
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'seguimientos_id', 'user_id'], 'integer'],
            [['folio', 'lugar', 'fecha', 'tema', 'datetime', 'timestamp'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Minutas::find();

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
            'seguimientos_id' => $this->seguimientos_id,
            'fecha' => $this->fecha,
            'datetime' => $this->datetime,
            'timestamp' => $this->timestamp,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'folio', $this->folio])
            ->andFilterWhere(['like', 'lugar', $this->lugar])
            ->andFilterWhere(['like', 'tema', $this->tema]);

        return $dataProvider;
    }
}
