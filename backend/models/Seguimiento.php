<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "seguimiento".
 *
 * @property int $id
 * @property string|null $folio
 * @property string|null $tema
 * @property string|null $tareas
 * @property string|null $fecha_inicio
 * @property string|null $fecha_vencimiento
 * @property string|null $observaciones
 * @property int|null $status
 * @property string|null $fecha_captura
 * @property int|null $user_id
 * @property int|null $leido
 *
 * @property Minutas[] $minutas
 * @property Notificaciones[] $notificaciones
 * @property Participantes[] $participantes
 * @property Secretarias[] $secretarias
 * @property Responsables[] $responsables
 * @property Secretarias[] $secretarias0
 * @property User $user
 */
class Seguimiento extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'seguimiento';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tareas', 'observaciones'], 'string'],
            [['fecha_inicio', 'fecha_vencimiento', 'fecha_captura'], 'safe'],
            [['status', 'user_id', 'leido'], 'integer'],
            [['folio', 'tema'], 'string', 'max' => 255],
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
            'tema' => 'Tema',
            'tareas' => 'Tareas',
            'fecha_inicio' => 'Fecha Inicio',
            'fecha_vencimiento' => 'Fecha Vencimiento',
            'observaciones' => 'Observaciones',
            'status' => 'Status',
            'fecha_captura' => 'Fecha Captura',
            'user_id' => 'User ID',
            'leido' => 'Leido',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMinutas()
    {
        return $this->hasMany(Minutas::className(), ['seguimientos_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotificaciones()
    {
        return $this->hasMany(Notificaciones::className(), ['seguimientos_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParticipantes()
    {
        return $this->hasMany(Participantes::className(), ['seguimientos_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSecretarias()
    {
        return $this->hasMany(Secretarias::className(), ['id' => 'secretarias_id'])->viaTable('participantes', ['seguimientos_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResponsables()
    {
        return $this->hasMany(Responsables::className(), ['seguimientos_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSecretarias0()
    {
        return $this->hasMany(Secretarias::className(), ['id' => 'secretarias_id'])->viaTable('responsables', ['seguimientos_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
