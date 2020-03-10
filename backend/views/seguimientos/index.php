<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SeguimientosBuscar */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Seguimientos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="seguimientos-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->user->can('admin-nuevo-seguimiento')) {
        ?>
        <?= Html::button('Nuevo Seguimiento', ['value' => Url::to(['nuevo-seguimiento']), 'title' => 'Nuevo Seguimiento', 'class' => 'showModalButton btn btn-success']); ?>
    <?php } ?>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="panel panel-header table-responsive" >
        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'folio',
                [
                    'attribute' => 'secretaria_responsable',
                    'visible' => Yii::$app->user->can('admin-filtro-responsable') ? true : false,
                    'filter' => Html::activeDropDownList($searchModel, 'secretaria_responsable', \yii\helpers\ArrayHelper::map(\backend\models\Secretarias::find()->asArray()->all(), 'id', 'nombre'), ['class' => 'form-control', 'prompt' => 'Seleccionar Secretaria']),
                    'value' => function($model) {
                        $responsabletema = '';
                        foreach ($model->responsables as $resonsable) {

                            $responsabletema .= $resonsable->secretarias->nombre . '<br>';

//                    $groupNames[] = $resonsable->secretarias->nombre;
//                 return implode("\n", $groupNames);
                        }
                        return $responsabletema;


                        // return  $model->secretariasSeguimientos;
                        //return implode("\n", $groupNames);
                    },
                    'format' => 'html',
                ],
                [
                    'attribute' => 'secretaria_participante',
                    'visible' => Yii::$app->user->can('admin-filtro-participante') ? true : false,
                    'filter' => Html::activeDropDownList($searchModel, 'secretaria_participante', \yii\helpers\ArrayHelper::map(\backend\models\Secretarias::find()->asArray()->all(), 'id', 'nombre'), ['class' => 'form-control', 'prompt' => 'Seleccionar Secretaria']),
                    'value' => function($model) {

                        $participantestema = '';
                        foreach ($model->participantes as $participante) {

                            $participantestema .= $participante->secretarias->nombre . '<br>';

//                    $groupNames[] = $resonsable->secretarias->nombre;
//                 return implode("\n", $groupNames);
                        }
                        return $participantestema;


                        // return  $model->secretariasSeguimientos;
                        //return implode("\n", $groupNames);
                    },
                    'format' => 'html',
                ],
                'tema',
                [
                    'attribute' => 'tareas',
                    'format' => 'text',
                    'format' => 'html',
                    'value' => 'tareas',
                ],
                'fecha_inicio',
                'fecha_vencimiento',
                [
                    'label' => 'Estado',
                    'attribute' => 'status',
                    'filter' => array("0" => "Vencido", "1" => "Completado", "2" => "En Proceso", "3" => "Sin Atencion"),
                    'value' => function ($data) {
                        if ($data->status == 0) {
                            return 'Vencido'; // or return true;
                        } elseif ($data->status == 1) {
                            return 'Completado'; // or return true;        
                        } elseif ($data->status == 2) {
                            return 'En Proceso'; // or return true;        
                        } else {
                            return 'Sin Atencion  '; // or return true;   
                        }
                    },
                ],
//            'id',
//            'folio',
//            'tema',
//            'tareas:ntext',
//            'fecha_inicio',
//            //'fecha_vencimiento',
//            //'observaciones:ntext',
//            //'status',
//            //'fecha_captura',
//            //'user_id',
//            //'leido',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'contentOptions' => ['style' => 'width:260px;'],
                    'header' => 'Menú',
                    'template' => '{view}',
                    'buttons' => [
                        //view button
                        'view' => function ($url, $model) {

                            if (Yii::$app->user->can('admin-button')) {
                                return '<div class="dropdown">
                          <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Opciones
                          <span class="caret"></span></button>
                          <ul class="dropdown-menu">
                          <li>' . Html::button('Editar', ['value' => Url::to(['editar-seguimiento', 'id' => $model->id]), 'title' => 'Editar  Seguimiento', 'class' => 'showModalButton btn btn-warning']) . ' </li>
                          <li>' . Html::a('Eliminar', ['delete', 'id' => $model->id], [
                                            'class' => 'btn btn-danger',
                                            'data' => [
                                                'confirm' => '¿Estás seguro de que deseas eliminar este seguimiento?',
                                                'method' => 'post',
                                            ],
                                        ]) . ' </li>    
                  <li>' . Html::button('Generar Minuta', ['value' => Url::to(['generar-minuta', 'id' => $model->id]), 'title' => 'Generar  Minuta', 'class' => 'showModalButton btn btn-primary']) . ' </li>'
                                        . '<li>' . Html::a('<span>Detalles</span>', Url::to(['view', 'id' => $model->id]), ['title' => 'Update', 'class' => 'btn btn-success']) . ' </li>
                          </ul>
                        </div>';
                            } elseif (Yii::$app->user->can('user-button') && $model->minutas == true) {
                                return '<div class="dropdown">
                          <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Opciones
                          <span class="caret"></span></button>
                          <ul class="dropdown-menu">
                          <li>' . Html::a('<span>Detalles</span>', Url::to(['minutas', 'id' => $model->id]), ['title' => 'Detalles', 'class' => 'btn btn-success']) . ' </li>
                        
                          </ul>
                        </div>';
                            }
                        },
                    ],
                ],
            ],
        ]);
        ?>

        <?php Pjax::end(); ?>
    </div>
</div>
