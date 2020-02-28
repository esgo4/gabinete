<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "m_proyectos".
 *
 * @property int $seguimiento_id
 * @property int $m_proyectos_estrategicos_id
 *
 * @property Seguimientos $seguimientos
 * @property ProyectosEstrategicos $mProyectosEstrategicos
 */
class MProyectos_1 extends \yii\db\ActiveRecord
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
            [['seguimiento_id', 'm_proyectos_estrategicos_id'], 'required'],
            [['seguimiento_id', 'm_proyectos_estrategicos_id'], 'integer'],
            [['seguimiento_id', 'm_proyectos_estrategicos_id'], 'unique', 'targetAttribute' => ['minutas_id', 'm_proyectos_estrategicos_id']],
            [['seguimiento_id'], 'exist', 'skipOnError' => true, 'targetClass' => Seguimientos::className(), 'targetAttribute' => ['seguimiento_id' => 'id']],
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
