<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Usuarios */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usuarios-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <div id="correspondencia" class="panel">
                                    <div class="panel-hdr">
                                        <h2>
                                            Verifica tus Datos <span class="fw-300"><i></i></span>
                                        </h2>
                                        <div class="panel-toolbar">
<!--                                            <button class="btn btn-panel waves-effect waves-themed" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                                            <button class="btn btn-panel waves-effect waves-themed" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                                            <button class="btn btn-panel waves-effect waves-themed" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>-->
                                        </div>
                                    </div>
                                    <div class="panel-container show">
                                        <div class="panel-content">
<!--                                            <div class="panel-tag">
                                                We recommend using client-side validation, but in case you require server-side validation, you can indicate invalid and valid form fields with <code>.is-invalid</code> and <code>.is-valid</code>. Note that <code>.invalid-feedback</code> is also supported with these classes
                                            </div>-->
                                       
                                                <div class="form-row">
                                                     <div class="col-xs-12 col-sm-4 col-lg-4">
                                                     <?= $form->field($model, 'username')->textInput(['maxlength' => true,'readonly' => true]) ?>

                                                    </div>
                                                     <div class="col-xs-12 col-sm-4 col-lg-4">
                                                     <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
                                                    </div>
                                                     <div class="col-xs-12 col-sm-4 col-lg-4">
                                                     <?= $form->field($model, 'nombres')->textInput(['maxlength' => true]) ?>
                                                    </div>
                                                     <div class="col-xs-12 col-sm-4 col-lg-4">
                                                   <?= $form->field($model, 'apellido_paterno')->textInput(['maxlength' => true]) ?>
                                                    </div>
                                                     <div class="col-xs-12 col-sm-4 col-lg-4">
                                                     <?= $form->field($model, 'apellido_materno')->textInput(['maxlength' => true]) ?>
                                                    </div>
                                                     <div class="col-xs-12 col-sm-4 col-lg-4">
                                                    <?= $form->field($model, 'secretarias_id')->textInput(['value' => $model->secretarias0->nombre,'readonly' => true]) ?>
                                                    </div>
                                                </div>
                                                
                                             
                                        </div>
                                    </div>
                                </div>
 

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
