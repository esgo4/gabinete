<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "proyectos_estrategicos".
 *
 * @property int $id
 * @property string|null $nombre
 *
 * @property MProyectos[] $mProyectos
 * @property Minutas[] $minutas
 */
class ProyectosEstrategicos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'proyectos_estrategicos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMProyectos()
    {
        return $this->hasMany(MProyectos::className(), ['m_proyectos_estrategicos_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMinutas()
    {
        return $this->hasMany(Minutas::className(), ['id' => 'minutas_id'])->viaTable('m_proyectos', ['m_proyectos_estrategicos_id' => 'id']);
    }
}
