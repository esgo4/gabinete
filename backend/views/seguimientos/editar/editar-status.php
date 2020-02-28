<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap4\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\models\Seguimientos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="seguimientos-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <div id="correspondencia" class="panel">
                                    <div class="panel-hdr">
                                        <h2>
                                            Editar <span class="fw-300"><i>Status</i></span>
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
                                                    <div class="col-xs-12 col-sm-4 col-lg-8">
                                                  <?= $form->field($model, 'tema')->textInput(['readonly' => true]) ?>   
                                                    </div>
                                                     <div class="col-xs-12 col-sm-4 col-lg-12">
                                                     <?= $form->field($model, 'tareas')->textarea(['rows' => 6,'readonly'=>'true']) ?>
                                                    </div>
                                                   <div class="col-xs-12 col-sm-4 col-lg-4">
                                                         <?= $form->field($model, 'status')->dropDownList(
                                    $status_disponibles, 
                                    ['prompt'=>'Seleccionar Nuevo Status...']) ?>
                                                    </div>
                                                     <div class="col-xs-12 col-sm-4 col-lg-4">
                                                     
                                                    </div>
                                                     <div class="col-xs-12 col-sm-4 col-lg-4">
                                                     
                                                    </div>
                                                </div>
                                             
                                             
                                        </div>
                                    </div>
                                </div>



    <div class="form-group">
        <?= Html::submitButton('Cambiar Status', ['class' => 'btn btn-success',"data-confirm" => Yii::t("yii", "¿Está seguro de modificar el ESTATUS de este Tema?")]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php


 
$script = <<< JS
        
       
         tinymce.init({
            selector: "#seguimientos-tareas",
            readonly : 1
        });
        

         
        
JS;
$this->registerJs($script);
?>