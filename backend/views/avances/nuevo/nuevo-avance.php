<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;
/* @var $this yii\web\View */
/* @var $model app\models\Avances */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="avances-form">

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>


    
    <div id="correspondencia" class="panel">
                                    <div class="panel-hdr">
                                        <h2>
                                            Agregar Avance <span class="fw-300"><i></i></span>
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
                                                          <?=
                                    $form->field($model, 'acuerdos_id')->widget(Select2::classname(), [
                                        'data' => $acuerdos,
                                        'options' => ['placeholder' => 'Seleccionar Acuerdo ...', 'id' => 'acuerdos_id'],
                                        'pluginOptions' => [
                                            'allowClear' => true,
                                        ],
                                    ])->label('Acuerdos');
                                    ?>
                                    
                                                    </div>
                                                   <div class="col-xs-12 col-sm-4 col-lg-4">
                                                  <?= $form->field($model, 'fecha')->textInput(['value' => date('Y-m-d'), 'readonly' => true]) ?>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-4 col-lg-4">
                                                   <?= $form->field($model, 'usuario')->textInput(['value' => 'granados', 'readonly' => true]) ?>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-4 col-lg-12">
    <?= $form->field($model, 'comentario')->textarea(['rows' => 6]) ?>
                                                    </div>
                                            <div class="col-xs-12 col-sm-4 col-lg-12">
    <?=
                                                $form->field($modelimg, 'archivo[]')->widget(\kartik\file\FileInput::classname(), [
                                                    'options' => ['accept' => '*','multiple' => true],
                                                    'pluginOptions'=>[
                                                    'allowedFileExtensions' => ['jpg', 'gif', 'png', 'pdf', 'docx'],
                                                ],
                                                  ]  );
                                                ?>
                                                    </div>

                                                    </div>
                
                                                </div>
                                                
                                             
                                        </div>
                                    </div>
                           


    <div class="form-group">
        <?= Html::submitButton('Enviar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
