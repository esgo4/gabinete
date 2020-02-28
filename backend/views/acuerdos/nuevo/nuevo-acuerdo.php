<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model backend\models\Acuerdos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="acuerdos-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <div id="panel-1" class="panel">
        <div class="panel-hdr">
            <h2>
              NUEVO ACUERDO <span class="fw-300"></span>
            </h2>
            <div class="panel-toolbar">
                <button class="btn btn-panel waves-effect waves-themed" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                <button class="btn btn-panel waves-effect waves-themed" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
            </div>
        </div>
        <div class="panel-container show">
            <div class="panel-content">
<!--                <div class="panel-tag">
                    You can mix and match any color styles, below is what we were found to be an interesting match. Please note the colors will not be compatible with the modifier <code>.mod-panel-clean</code>
                </div>-->
                <div class="form-row">
                    <div class="col-xs-12 col-sm-4 col-lg-12">
                         <?= $form->field($model, 'acuerdo')->textarea(['rows' => 6]) ?>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-lg-6">
                       <?=
$form->field($model, 'secretaria_id')->widget(Select2::classname(), [
    'name' => 'secretaria_id',
    'language' => 'es',
    'data' => $secretarias,
    'options' => [ 'placeholder' => 'Seleccionar Secretaria', 'id' => 'secretaria_id'],
    'pluginOptions' => [
//                            'ajax' => [
//                                //'url' => Url::to(['participantes']),
//                                'url' => Url::to(['responsables']),
//                                'dataType' => 'json',
//                                'data' => new JsExpression('function(params) {
//                                        var arr = ($("#secretaria_participante").val());
//                                        var arr_length = arr.length;
//                                        var demo = [];
//                                        for (var i = 0; i < arr_length; i++) {
//                                            demo += arr[i] + ",";
//                                        }
//                                        console.log(demo);
//                                        return { dependencia: demo, q:params.term, page: params.page };
//                                    }'
//                                ),
//                            ],
    ],
])
?>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-lg-6">
                       <?=
                        $form->field($model, 'fecha_termino')->widget(yii\jui\DatePicker::className(), [
                            'model' => $model,
                            'attribute' => 'fecha_termino',
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
                                'id' => 'fecha_termino',
                                'class' => 'form-control',
                            //'autocomplete'=>'off'
                            ],])
                        ?>
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


