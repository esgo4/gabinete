<?php

namespace backend\models;

use Yii;
use backend\models\Seguimiento;
use dektrium\user\models\User;
/**
 * This is the model class for table "minutas".
 *
 * @property int $id
 * @property string|null $folio
 * @property string|null $lugar
 * @property int|null $seguimientos_id
 * @property string|null $fecha
 * @property string|null $tema
 * @property string|null $datetime
 * @property string|null $timestamp
 * @property int|null $user_id
 *
 * @property Acuerdos[] $acuerdos
 * @property MProyectos[] $mProyectos
 * @property ProyectosEstrategicos[] $mProyectosEstrategicos
 * @property Seguimiento $seguimientos
 * @property User $user
 * @property Notificaciones[] $notificaciones
 */
class Minutas extends \yii\db\ActiveRecord
{
    public $secretarias_responsables;
    public $secretarias_participantes;
    public $proyectos_estrategicos;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'minutas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['lugar', 'proyectos_estrategicos'], 'required'],
            [['seguimientos_id', 'user_id'], 'integer'],
            [['fecha', 'datetime', 'timestamp', 'secretarias_participantes', 'proyectos_estrategicos', 'secretarias_responsables'], 'safe'],
            [['folio', 'lugar', 'tema'], 'string', 'max' => 255],
            [['seguimientos_id'], 'exist', 'skipOnError' => true, 'targetClass' => Seguimiento::className(), 'targetAttribute' => ['seguimientos_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'folio' => 'Folio',
            'lugar' => 'Lugar',
            'seguimientos_id' => 'Seguimientos ID',
            'fecha' => 'Fecha',
            'tema' => 'Tema',
            'datetime' => 'Datetime',
            'timestamp' => 'Timestamp',
            'user_id' => 'User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAcuerdos()
    {
        return $this->hasMany(Acuerdos::className(), ['minutas_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMProyectos()
    {
        return $this->hasMany(MProyectos::className(), ['minutas_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMProyectosEstrategicos()
    {
        return $this->hasMany(ProyectosEstrategicos::className(), ['id' => 'm_proyectos_estrategicos_id'])->viaTable('m_proyectos', ['minutas_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSeguimientos()
    {
        return $this->hasOne(Seguimiento::className(), ['id' => 'seguimientos_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotificaciones()
    {
        return $this->hasMany(Notificaciones::className(), ['minutas_id' => 'id']);
    }
}
