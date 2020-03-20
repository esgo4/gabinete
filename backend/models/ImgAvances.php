<?php

namespace backend\models;

use Yii;
use backend\models\Avances;
use dektrium\user\models\User;
/**
 * This is the model class for table "img_avances".
 *
 * @property int $id
 * @property int|null $avances_id
 * @property string|null $archivo
 * @property string|null $fecha_captura
 * @property string|null $timestamp
 * @property int|null $user_id
 *
 * @property Avances $avances
 * @property User $user
 */
class ImgAvances extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'img_avances';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['avances_id', 'user_id'], 'integer'],
            [['fecha_captura', 'timestamp'], 'safe'],
            [['archivo'], 'string', 'max' => 255],
            [['archivo'], 'required', 'message'=>'No puede estar vacío'],
            [['avances_id'], 'exist', 'skipOnError' => true, 'targetClass' => Avances::className(), 'targetAttribute' => ['avances_id' => 'id']],
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
            'avances_id' => 'Avances ID',
            'archivo' => 'Archivo',
            'fecha_captura' => 'Fecha Captura',
            'timestamp' => 'Timestamp',
            'user_id' => 'User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAvances()
    {
        return $this->hasOne(Avances::className(), ['id' => 'avances_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
