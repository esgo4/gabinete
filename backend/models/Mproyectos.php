<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "m_proyectos".
 *
 * @property int $minutas_id
 * @property int $m_proyectos_estrategicos_id
 *
 * @property Minutas $minutas
 * @property ProyectosEstrategicos $mProyectosEstrategicos
 */
class MProyectos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'm_proyectos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['minutas_id', 'm_proyectos_estrategicos_id'], 'required'],
            [['minutas_id', 'm_proyectos_estrategicos_id'], 'integer'],
            [['minutas_id', 'm_proyectos_estrategicos_id'], 'unique', 'targetAttribute' => ['minutas_id', 'm_proyectos_estrategicos_id']],
            [['minutas_id'], 'exist', 'skipOnError' => true, 'targetClass' => Minutas::className(), 'targetAttribute' => ['minutas_id' => 'id']],
            [['m_proyectos_estrategicos_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProyectosEstrategicos::className(), 'targetAttribute' => ['m_proyectos_estrategicos_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'minutas_id' => 'Minutas ID',
            'm_proyectos_estrategicos_id' => 'M Proyectos Estrategicos ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMinutas()
    {
        return $this->hasOne(Minutas::className(), ['id' => 'minutas_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMProyectosEstrategicos()
    {
        return $this->hasOne(ProyectosEstrategicos::className(), ['id' => 'm_proyectos_estrategicos_id']);
    }
}
