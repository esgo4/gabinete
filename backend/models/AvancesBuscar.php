<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Avances;

/**
 * AvancesBuscar represents the model behind the search form of `backend\models\Avances`.
 */
class AvancesBuscar extends Avances
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'secretarias_id', 'acuerdos_id', 'user_id'], 'integer'],
            [['comentario', 'fecha_captura', 'timestamp'], 'safe'],
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
        $query = Avances::find();

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
            'secretarias_id' => $this->secretarias_id,
            'acuerdos_id' => $this->acuerdos_id,
            'fecha_captura' => $this->fecha_captura,
            'timestamp' => $this->timestamp,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'comentario', $this->comentario]);

        return $dataProvider;
    }
}
