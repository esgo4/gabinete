<?php

namespace backend\models;

use Yii;
use backend\models\Minutas;
use backend\models\Secretarias;
use dektrium\user\models\User;
/**
 * This is the model class for table "acuerdos".
 *
 * @property int $id
 * @property string|null $acuerdo
 * @property int|null $minutas_id
 * @property int|null $secretaria_id
 * @property string|null $plazo
 * @property string|null $fecha_inicio
 * @property string|null $fecha_termino
 * @property string|null $timestamp
 * @property int|null $user_id
 *
 * @property Minutas $minutas
 * @property Secretarias $secretaria
 * @property User $user
 * @property Avances[] $avances
 * @property Notificaciones[] $notificaciones
 */
class Acuerdos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'acuerdos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['acuerdo','fecha_termino','secretaria_id'], 'required','message'=>'No puede estar vacío'],
            [['acuerdo'], 'string'],
            [['minutas_id', 'secretaria_id', 'user_id'], 'integer'],
            [['fecha_inicio', 'fecha_termino', 'timestamp'], 'safe'],
            [['plazo'], 'string', 'max' => 255],
            [['minutas_id'], 'exist', 'skipOnError' => true, 'targetClass' => Minutas::className(), 'targetAttribute' => ['minutas_id' => 'id']],
            [['secretaria_id'], 'exist', 'skipOnError' => true, 'targetClass' => Secretarias::className(), 'targetAttribute' => ['secretaria_id' => 'id']],
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
            'acuerdo' => 'Acuerdo',
            'minutas_id' => 'Minutas ID',
            'secretaria_id' => 'Secretaria',
            'plazo' => 'Plazo',
            'fecha_inicio' => 'Fecha Inicio',
            'fecha_termino' => 'Fecha Termino',
            'timestamp' => 'Timestamp',
            'user_id' => 'User ID',
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
    public function getSecretaria()
    {
        return $this->hasOne(Secretarias::className(), ['id' => 'secretaria_id']);
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
    public function getAvances()
    {
        return $this->hasMany(Avances::className(), ['acuerdos_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotificaciones()
    {
        return $this->hasMany(Notificaciones::className(), ['acuerdos_id' => 'id']);
    }
}
