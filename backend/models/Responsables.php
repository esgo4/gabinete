<?php

namespace backend\models;

use Yii;
use backend\models\Secretarias;
use backend\models\Seguimiento;
/**
 * This is the model class for table "responsables".
 *
 * @property int $secretarias_id
 * @property int $seguimientos_id
 *
 * @property Secretarias $secretarias
 * @property Seguimiento $seguimientos
 */
class Responsables extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'responsables';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['secretarias_id', 'seguimientos_id'], 'required'],
            [['secretarias_id', 'seguimientos_id'], 'integer'],
            [['secretarias_id', 'seguimientos_id'], 'unique', 'targetAttribute' => ['secretarias_id', 'seguimientos_id']],
            [['secretarias_id'], 'exist', 'skipOnError' => true, 'targetClass' => Secretarias::className(), 'targetAttribute' => ['secretarias_id' => 'id']],
            [['seguimientos_id'], 'exist', 'skipOnError' => true, 'targetClass' => Seguimiento::className(), 'targetAttribute' => ['seguimientos_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'secretarias_id' => 'Secretarias ID',
            'seguimientos_id' => 'Seguimientos ID',
        ];
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
    public function getSeguimientos()
    {
        return $this->hasOne(Seguimiento::className(), ['id' => 'seguimientos_id']);
    }
}
