<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Acuerdos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="acuerdos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'acuerdo')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'minutas_id')->textInput() ?>

    <?= $form->field($model, 'secretaria_id')->textInput() ?>

    <?= $form->field($model, 'plazo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fecha_inicio')->textInput() ?>

    <?= $form->field($model, 'fecha_termino')->textInput() ?>

    <?= $form->field($model, 'timestamp')->textInput() ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
