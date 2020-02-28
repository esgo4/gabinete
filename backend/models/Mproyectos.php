<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "m_proyectos".
 *
 * @property int $seguimiento_id
 * @property int $m_proyectos_estrategicos_id
 *
 * @property ProyectosEstrategicos $mProyectosEstrategicos
 * @property Seguimiento $seguimiento
 */
class Mproyectos extends \yii\db\ActiveRecord
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
            [['seguimiento_id', 'm_proyectos_estrategicos_id'], 'unique', 'targetAttribute' => ['seguimiento_id', 'm_proyectos_estrategicos_id']],
            [['m_proyectos_estrategicos_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProyectosEstrategicos::className(), 'targetAttribute' => ['m_proyectos_estrategicos_id' => 'id']],
            [['seguimiento_id'], 'exist', 'skipOnError' => true, 'targetClass' => Seguimiento::className(), 'targetAttribute' => ['seguimiento_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'seguimiento_id' => 'Seguimiento ID',
            'm_proyectos_estrategicos_id' => 'M Proyectos Estrategicos ID',
        ];
    }

    /**
     * Gets query for [[MProyectosEstrategicos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMProyectosEstrategicos()
    {
        return $this->hasOne(ProyectosEstrategicos::className(), ['id' => 'm_proyectos_estrategicos_id']);
    }

    /**
     * Gets query for [[Seguimiento]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSeguimiento()
    {
        return $this->hasOne(Seguimiento::className(), ['id' => 'seguimiento_id']);
    }
}
