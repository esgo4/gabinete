<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap4\ActiveForm;
use kartik\widgets\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Minutas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="minutas-form">




    <?php $form = ActiveForm::begin(); ?>

    <div id="panel-1" class="panel">
        <div class="panel-hdr">
            <h2>
                GENERAR MINUTA <span class="fw-300"></span>
            </h2>
            <div class="panel-toolbar">
                <button class="btn btn-panel waves-effect waves-themed" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                <button class="btn btn-panel waves-effect waves-themed" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                <!-- <button class="btn btn-panel waves-effect waves-themed" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>-->
            </div>
        </div>
        <div class="panel-container show">
            <div class="panel-content">
<!--                <div class="panel-tag">
                    You can mix and match any color styles, below is what we were found to be an interesting match. Please note the colors will not be compatible with the modifier <code>.mod-panel-clean</code>
                </div>-->
                <div class="form-row">
                    <div class="col-xs-12 col-sm-4 col-lg-4">
                        <?= $form->field($minutas, 'lugar')->textInput() ?>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-lg-4">

                    </div>
                    <div class="col-xs-12 col-sm-4 col-lg-4">
                        <?= $form->field($minutas, 'fecha')->textInput(['readonly' => true]) ?>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-lg-12">
                        <?= $form->field($minutas, 'tema')->textarea(['readonly' => 6]) ?>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-lg-6">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Secretaria Responsable</th>
                                </tr>
                            </thead>
                            <?php
                                $responsables = backend\models\Responsables::find()->where(['seguimientos_id' => $minutas->seguimientos_id])->all();
                                foreach ($responsables as $responsable) {
                                    echo '<tbody>   
                                            <tr>
                                              <td>' . $responsable->secretarias->nombre . '</td>
                                            </tr>
                                          </tbody>';
                                }
                            ?>
                        </table>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-lg-6">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Secretaria Participante</th>
                                </tr>
                            </thead>
                            <?php
                                $participantes = backend\models\Participantes::find()->where(['seguimientos_id' => $minutas->seguimientos_id])->all();
                                foreach ($participantes as $participante) {
                                    echo ' <tbody>
                                            <tr>
                                                <td>' . $participante->secretarias->nombre . '</td>
                                            </tr>
                                         </tbody>';
                                }
                            ?>
                        </table>
                    </div>


<!--                    <div class="col-xs-12 col-sm-4 col-lg-4">
                        <?php
                            /*$form->field($minutas, 'proyectos_estrategicos')->widget(Select2::classname(), [
                                'name' => 'proyectos_estrategicos',
                                'language' => 'es',
                                'data' => $proyectos_estrategicos,
                                'options' => ['multiple' => true, 'placeholder' => 'Seleccionar Proyectos Bandera', 'id' => 'proyectos_estrategicos'],
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
                            ])*/
                        ?>
                    </div>-->

                </div>
            </div>
        </div>
    </div>



    <div class="form-group">
<?= Html::submitButton('Generar', ['class' => 'btn btn-success']) ?>
    </div>

        <?php ActiveForm::end(); ?>

</div>
