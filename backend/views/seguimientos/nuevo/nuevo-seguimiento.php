<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap4\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\Url;
use yii\web\JsExpression;
/* @var $this yii\web\View */
/* @var $model backend\models\Seguimientos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="seguimientos-form">

    <?php
    $form = ActiveForm::begin([
                'id' => 'form',
                'options' => [
                    'autocomplete' => 'off'
                ],
                    //'id'=>$model->fornmName(),
                    // 'enableAjaxValidation' => true,
                    // 'validationUrl' => Url::toRoute('validacion-formulario')
    ]);
    ?>

    <div id="nuevo-seguimiento" class="panel">
        <div class="panel-hdr">
            <h2>
                NUEVO REGISTRO <span class="fw-300"></span>
            </h2>
            <div class="panel-toolbar">
                <button class="btn btn-panel waves-effect waves-themed" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                <button class="btn btn-panel waves-effect waves-themed" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                <!--                <button class="btn btn-panel waves-effect waves-themed" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>-->
            </div>
        </div>
        <div class="panel-container show">
            <div class="panel-content">
                <!--                <div class="panel-tag">
                                    You can mix and match any color styles, below is what we were found to be an interesting match. Please note the colors will not be compatible with the modifier <code>.mod-panel-clean</code>
                                </div>-->
                <div class="form-row">
                    <div class="col-xs-12 col-sm-4 col-lg-12">
       <?= $form->field($model, 'tema')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-lg-12">
 <?= $form->field($model, 'tareas')->textarea(['rows' => 6]) ?>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-lg-6">
                      <?=
                        $form->field($model, 'secretaria_responsable')->widget(Select2::classname(), [
                            'name' => 'secretaria_responsable',
                            'language' => 'es',
                            'data' => $secretarias_responsables,
                            'options' => ['multiple' => true, 'placeholder' => 'Seleccionar Responsable', 'id' => 'secretaria_responsable'],
                              'pluginOptions' => [
                                  
                            'ajax' => [
                                //'url' => Url::to(['participantes']),
                                'url' => Url::to(['responsables']),
                                'dataType' => 'json',
                                'data' => new JsExpression('function(params) {
                                        var arr = ($("#secretaria_participante").val());
                                        var arr_length = arr.length;
                                        var demo = [];
                                        for (var i = 0; i < arr_length; i++) {
                                            demo += arr[i] + ",";
                                        }
                                        console.log(demo);
                                        return { dependencia: demo, q:params.term, page: params.page };
                                    }'
                                ),
                            ],
                            ],
                        ])
                        ?>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-lg-6">
                     <?=
                        $form->field($model, 'secretaria_participante')->widget(Select2::classname(), [
                            'name' => 'secretaria_participante',
                            'language' => 'es',
                            //'data' => $secretarias_participantes,
                            'options' => ['multiple' => true, 'placeholder' => 'Seleccionar Responsable', 'id' => 'secretaria_participante'],
                            'pluginOptions' => [
                            'ajax' => [
                                //'url' => Url::to(['participantes']),
                                'url' => Url::to(['participantes']),
                                'dataType' => 'json',
                                'data' => new JsExpression('function(params) {
                                        var arr = ($("#secretaria_responsable").val());
                                        var arr_length = arr.length;
                                        var demo = [];
                                        for (var i = 0; i < arr_length; i++) {
                                            demo += arr[i] + ",";
                                        }
                                        console.log(demo);
                                          return { dependencia: demo, q:params.term, page: params.page };
                                    }'
                                ),
                            ],
                            ],
                        ])
                        ?>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-lg-4">
                  <?=
                        $form->field($model, 'fecha_inicio')->widget(yii\jui\DatePicker::className(), [
                            'model' => $model,
                            'attribute' => 'fecha_inicio',
                            'language' => 'es',
                            //'dateFormat' => 'yyyy-MM-dd',
                            'dateFormat' => 'yyyy-MM-dd',
                            'clientOptions' => [
                                'changeMonth' => true,
                                'yearRange' => '1900:' . (date('Y') + 1),
                                'changeYear' => true,
                                'readOnly' => true,
                                'autoSize' => true,],
                            'options' => [
                                'id' => 'fecha_inicio',
                                'class' => 'form-control',
                            //'autocomplete'=>'off'
                            ],])
                        ?>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-lg-4">
                  <?=
                                $form->field($model, 'fecha_vencimiento')->widget(\kartik\widgets\DatePicker::classname(), [
    'options' => ['placeholder' => ''],
    'pluginOptions' => [
        'autoclose' => true,
        'format' => 'yyyy-m-d',
        'startDate' => date('Y-m-d')
    ]
]);
//                        $form->field($model, 'fecha_vencimiento')->widget(yii\jui\DatePicker::className(), [
//                            'model' => $model,
//                            'attribute' => 'fecha_vencimiento',
//                            'language' => 'es',
//                            //'dateFormat' => 'yyyy-MM-dd',
//                            'dateFormat' => 'yyyy-MM-dd',
//                            'clientOptions' => [
//                                'changeMonth' => true,
//                                'yearRange' => '2015:' . (date('Y') + 1),
//                                'startDate' => date('Y-m-d'),
//                                'changeYear' => true,
//                                'readOnly' => true,
//                                'autoSize' => true,],
//                            'options' => [
//                                'id' => 'fecha_termino',
//                                'class' => 'form-control',
//                            //'autocomplete'=>'off'
//                            ],])
                        ?>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-lg-12">
               <?= $form->field($model, 'observaciones')->textarea(['rows' => 6]) ?>
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
<?php


 
$script = <<< JS
        
       
         tinymce.init({
            selector: "#seguimientos-tareas",
            readonly : 0
        });
        

         
        
JS;
$this->registerJs($script);
?>
    <?php
$script = <<< JS
jQuery(function() {
 
$(document).on("beforeValidate", "form", function(event, messages, deferreds) {
        //$(this).find(':submit').attr('disabled', true);
        


        
        console.log('BEFORE VALIDATE TEST');
    });
  $(document).on("beforeSubmit", "#form", function (event, messages) {
        console.log('Test new form');
        return true;
    });
    
    
});
JS;
$this->registerJs($script);
?>