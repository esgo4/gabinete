<?php

namespace backend\models;

use Yii;
use backend\models\Acuerdos;
use backend\models\Secretarias;
use dektrium\user\models\User;
/**
 * This is the model class for table "avances".
 *
 * @property int $id
 * @property int|null $secretarias_id
 * @property int|null $acuerdos_id
 * @property string|null $comentario
 * @property string|null $fecha_captura
 * @property string|null $timestamp
 * @property int|null $user_id
 *
 * @property Acuerdos $acuerdos
 * @property Secretarias $secretarias
 * @property User $user
 * @property ImgAvances[] $imgAvances
 * @property Notificaciones[] $notificaciones
 */
class Avances extends \yii\db\ActiveRecord
{
      const SCENARIO_NUEVO_ACANCE = 'SCENARIO_NUEVO_ACANCE';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'avances';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['acuerdos_id', 'comentario'], 'required', 'on' => self::SCENARIO_NUEVO_ACANCE],
            [['secretarias_id', 'acuerdos_id', 'user_id'], 'integer'],
            [['comentario'], 'string'],
            [['fecha_captura', 'timestamp'], 'safe'],
            [['acuerdos_id'], 'exist', 'skipOnError' => true, 'targetClass' => Acuerdos::className(), 'targetAttribute' => ['acuerdos_id' => 'id']],
            [['secretarias_id'], 'exist', 'skipOnError' => true, 'targetClass' => Secretarias::className(), 'targetAttribute' => ['secretarias_id' => 'id']],
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
            'secretarias_id' => 'Secretarias ID',
            'acuerdos_id' => 'Acuerdos ID',
            'comentario' => 'Comentario',
            'fecha_captura' => 'Fecha Captura',
            'timestamp' => 'Timestamp',
            'user_id' => 'User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAcuerdos()
    {
        return $this->hasOne(Acuerdos::className(), ['id' => 'acuerdos_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSecretarias()
    {
        return $this->hasOne(Secretarias::className(), ['id' => 'secretarias_id']);
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
    public function getImgAvances()
    {
        return $this->hasMany(ImgAvances::className(), ['avances_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotificaciones()
    {
        return $this->hasMany(Notificaciones::className(), ['avances_id' => 'id']);
    }
}
