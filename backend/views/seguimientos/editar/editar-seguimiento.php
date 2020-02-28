<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap4\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\Url;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $model app\models\Seguimientos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="seguimientos-form">

    <?php
    $form = ActiveForm::begin([
                'id' => 'nuevo-seguimiento-form',
                'options' => [
                    'autocomplete' => 'off'
                ],
                    //'id'=>$model->fornmName(),
                    // 'enableAjaxValidation' => true,
                    // 'validationUrl' => Url::toRoute('validacion-formulario')
    ]);
    ?>

    <div id="correspondencia" class="panel">
        <div class="panel-hdr">
            <h2>
                Nuevo Registro <span class="fw-300"><i></i></span>
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
                        'data' => [$valorresponsable],
                        'language' => 'es',
                        'options' => [
                            'multiple' => true,
                            'placeholder' => 'Seleccionar Responsable',
                            'id' => 'secretaria_responsable',
                            'value' => $idresponsable
                        ],
                        'pluginOptions' => [
                            'ajax' => [
                                //'url' => Url::to(['participantes']),
                                'url' => Url::to(['responsables']),
                                'dataType' => 'json',
                                'data' => new JsExpression('function(params) {
                                    var arr = ($("#secretaria_participante").val());
                                    var arr_length = arr.length;
                                    var dependencias = "";
                                    for (var i = 0; i < arr_length; i++) {
                                        dependencias += arr[i] + ",";
                                    }
                                    return { dependencia: dependencias };
                                }'),
                            ],
                        ],
                    ]) ?>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-lg-6">
                        <?=
                        $form->field($model, 'secretaria_participante')->widget(Select2::classname(), [
                            'name' => 'secretaria_participante',
                            'language' => 'es',
                             'data' => [$valorparticipante],
                            //'data' => $secretarias_participantes,
                            'options' => ['multiple' => true, 
                                'placeholder' => 'Seleccionar Responsable', 
                                'id' => 'secretaria_participante',
                                'value' => $idparticipante
                                ],
                            'pluginOptions' => [
                            'ajax' => [
                                //'url' => Url::to(['participantes']),
                                'url' => Url::to(['participantes']),
                                'dataType' => 'json',
                                'data' => new JsExpression('function(params) {
                                        var arr = ($("#secretaria_responsable").val());
                                        var arr_length = arr.length;
                                        var demo = "";
                                        for (var i = 0; i < arr_length; i++) {
                                            demo += arr[i] + ",";
                                        }
                                        return { dependencia: demo };
                                    }'
                                ),
                            ],
                            ],
                        ])
                        ?>
                        
                            <?php
//                        $form->field($model, 'secretaria_participante')->widget(Select2::classname(), [
//                            'name' => 'secretaria_participante',
//                            'language' => 'es',
//                            'data' => $secretarias_participantes,
//                            'options' => ['multiple' => true, 'placeholder' => 'Seleccionar Responsable'],
//                            'pluginOptions' => [
//                            'ajax' => [
//                                //'url' => Url::to(['participantes']),
//                                'url' => Url::to(['participantes']),
//                                'dataType' => 'json',
//                                'data' => new JsExpression('function(params) {
//                                        var arr = ($("#secretaria_responsable").val());
//                                        var arr_length = arr.length;
//                                        var demo = "";
//                                        for (var i = 0; i < arr_length; i++) {
//                                            demo += arr[i] + ",";
//                                        }
//                                        console.log(demo);
//                                        return { dependencia: demo };
//                                    }'
//                                ),
//                            ],
//                            ],
//                        ])
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
//                                'yearRange' => '1900:' . (date('Y') + 1),
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