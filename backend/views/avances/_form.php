<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Avances */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="avances-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'secretarias_id')->textInput() ?>

    <?= $form->field($model, 'acuerdos_id')->textInput() ?>

    <?= $form->field($model, 'comentario')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'fecha_captura')->textInput() ?>

    <?= $form->field($model, 'timestamp')->textInput() ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
