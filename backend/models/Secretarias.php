<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "secretarias".
 *
 * @property int $id
 * @property string|null $nombre
 * @property string|null $titular_nombres
 * @property string|null $titular_apellido_paterno
 * @property string|null $titular_apellido_materno
 * @property string|null $correo
 * @property int|null $activo
 * @property int|null $user_id
 *
 * @property Acuerdos[] $acuerdos
 * @property Avances[] $avances
 * @property Notificaciones[] $notificaciones
 * @property Participantes[] $participantes
 * @property Seguimiento[] $seguimientos
 * @property Responsables[] $responsables
 * @property Seguimiento[] $seguimientos0
 * @property User $user
 * @property User[] $users
 */
class Secretarias extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'secretarias';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['activo', 'user_id'], 'integer'],
            [['nombre', 'titular_nombres', 'titular_apellido_paterno', 'titular_apellido_materno', 'correo'], 'string', 'max' => 255],
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
            'nombre' => 'Nombre',
            'titular_nombres' => 'Titular Nombres',
            'titular_apellido_paterno' => 'Titular Apellido Paterno',
            'titular_apellido_materno' => 'Titular Apellido Materno',
            'correo' => 'Correo',
            'activo' => 'Activo',
            'user_id' => 'User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAcuerdos()
    {
        return $this->hasMany(Acuerdos::className(), ['secretaria_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAvances()
    {
        return $this->hasMany(Avances::className(), ['secretarias_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotificaciones()
    {
        return $this->hasMany(Notificaciones::className(), ['secretarias_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParticipantes()
    {
        return $this->hasMany(Participantes::className(), ['secretarias_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSeguimientos()
    {
        return $this->hasMany(Seguimiento::className(), ['id' => 'seguimientos_id'])->viaTable('participantes', ['secretarias_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResponsables()
    {
        return $this->hasMany(Responsables::className(), ['secretarias_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSeguimientos0()
    {
        return $this->hasMany(Seguimiento::className(), ['id' => 'seguimientos_id'])->viaTable('responsables', ['secretarias_id' => 'id']);
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
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['secretarias_id' => 'id']);
    }
}
