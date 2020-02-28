<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Acuerdos;

/**
 * AcuerdosBuscar represents the model behind the search form of `backend\models\Acuerdos`.
 */
class AcuerdosBuscar extends Acuerdos
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'minutas_id', 'secretaria_id', 'user_id'], 'integer'],
            [['acuerdo', 'plazo', 'fecha_inicio', 'fecha_termino', 'timestamp'], 'safe'],
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
        $query = Acuerdos::find();

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
            'minutas_id' => $this->minutas_id,
            'secretaria_id' => $this->secretaria_id,
            'fecha_inicio' => $this->fecha_inicio,
            'fecha_termino' => $this->fecha_termino,
            'timestamp' => $this->timestamp,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'acuerdo', $this->acuerdo])
            ->andFilterWhere(['like', 'plazo', $this->plazo]);

        return $dataProvider;
    }
}
