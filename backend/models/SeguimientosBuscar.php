<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Seguimientos;

/**
 * SeguimientosBuscar represents the model behind the search form of `backend\models\Seguimientos`.
 */
class SeguimientosBuscar extends Seguimientos
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status', 'user_id', 'leido'], 'integer'],
            [['folio', 'tema', 'tareas', 'fecha_inicio', 'fecha_vencimiento', 'observaciones', 'fecha_captura', 'secretaria_responsable', 'secretaria_participante'], 'safe'],
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
     if(\Yii::$app->user->can('admin-filtro')){
                $query = Seguimientos::find();  
           
        }  else {
           $query = Seguimientos::find()
                   ->joinWith('responsables as responsable')
                   ->joinWith('participantes as participante')
                   ->where(['responsable.secretarias_id'=> \Yii::$app->user->identity->secretarias_id])
                   ->orWhere(['participante.secretarias_id'=>\Yii::$app->user->identity->secretarias_id]); 
        }

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
        
         if ($this->secretaria_responsable == true) {
             
 

            $query->innerJoin('responsables', 'responsables.seguimientos_id = seguimiento.id')
                    ->where(['responsables.secretarias_id' => $this->secretaria_responsable]);
        }
        
         if($this->secretaria_participante == true){
            $query->innerJoin('participantes', 'participantes.seguimientos_id = seguimiento.id')
                ->where(['participantes.secretarias_id'=> $this->secretaria_participante]);
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'fecha_inicio' => $this->fecha_inicio,
            'fecha_vencimiento' => $this->fecha_vencimiento,
            'status' => $this->status,
            'fecha_captura' => $this->fecha_captura,
            'user_id' => $this->user_id,
            'leido' => $this->leido,
        ]);

        $query->andFilterWhere(['like', 'folio', $this->folio])
            ->andFilterWhere(['like', 'tema', $this->tema])
            ->andFilterWhere(['like', 'tareas', $this->tareas])
            ->andFilterWhere(['like', 'observaciones', $this->observaciones]);

        return $dataProvider;
    }
}
