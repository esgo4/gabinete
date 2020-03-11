<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\models\Seguimientos */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Seguimientos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
//\yii\web\YiiAsset::register($this);
use app\assets\ViewAsset;

ViewAsset::register($this);
?>
     <?php
  $timestamp = strtotime($model->timestamp);       
           
           $strTime = array("segundo", "minuto", "hora", "dia", "mes", "año");
           $length = array("60","60","24","30","12","10");

           $currentTime = date('Y-m-d H:i:s');


    
                        $diff     = time()- $timestamp;
                        for($i = 0; $diff >= $length[$i] && $i < count($length)-1; $i++) {
                        $diff = $diff / $length[$i];
                        }

                        $diff = round($diff);
                         "Hace " . $diff . " " . $strTime[$i] . "(s)";
        
?>
<main id="js-page-content" role="main" class="page-content">
                        <ol class="breadcrumb page-breadcrumb">
                            <li class="breadcrumb-item"><a href="/index.php/seguimientos">Inicio</a></li>
                            <li class="breadcrumb-item">Seguimientos</li>
                            <li class="breadcrumb-item active">Folio <?= $model->folio ?></li>
                        
                        </ol>
<!--                        <div class="subheader">
                            <h1 class="subheader-title">
                                <i class='subheader-icon fal fa-plus-circle'></i> Profile
                                <small>
                                    Profile layout
                                </small>
                            </h1>
                        </div>-->
                        <div class="row">
                            <div class="col-lg-6 col-xl-3 order-lg-1 order-xl-1">
                                <!-- profile summary -->
                                <div class="card mb-g rounded-top">
                                    <div class="row no-gutters row-grid">
                                        <div class="col-12">
                                            <div class="d-flex flex-column align-items-center justify-content-center p-4">
                                                <img src="/thema/logo.png" class="rounded-circle shadow-2 img-thumbnail" alt="">
                                                <h5 class="mb-0 fw-700 text-center mt-3">
                                                   Seguimiento Folio: <?= $model->folio ?>
                                                    <small class="text-muted mb-0">Status</small>
                                                       <?php
                                                        if($model->status == 0){
                                                         echo '<p class="text-muted text-center"><button type="button" class="btn btn-danger waves-effect waves-themed">Vencido</button></p>';
                                                         //echo '<span class="label label-success ">Completado</span>';
                                                        }elseif ($model->status == 1) {

                                                         echo '<p class="text-muted text-center"><button type="button" class="btn btn-success waves-effect waves-themed">Completado</button></p>';
                                                         //echo '<span class="label label-success ">Completado</span>';

                                                        }elseif ($model->status == 2) {
                                                          echo '<p class="text-muted text-center"><button type="button" class="btn btn-default waves-effect waves-themed">En Proceso</button></p>';
                                                         //echo '<span class="label label-success ">Completado</span>';   
                                                        } else {
                                                          echo '<p class="text-muted text-center"><button type="button" class="btn btn-warning waves-effect waves-themed">Sin Atención</button></p>';
                                                         //echo '<span class="label label-success ">Completado</span>';    
                                                        }
                                                        ?>
                                                </h5>                                               
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-center py-3">
                                                <h5 class="mb-0 fw-700">
                                                    <?= count($responsables)+ count($participantes) ?>
                                                    <small class="text-muted mb-0">Secretarias Involucradas</small>
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-center py-3">
                                                <h5 class="mb-0 fw-700">                                                
                                                    <?php                                                   
                                                        echo Html::a(count($avances_secretaria), ['view','id' => $model->id], ['class' => 'btn btn-success btn-sm']) 
                                                    ?>  
                                                    <br>
                                                    <small class="text-muted mb-0">Avances Reportados </small>
                                                    <!--<a href="/seguimientos/view?id= <?=$model->id?>" target="_self">Avances Reportados</a>-->
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                             <div class="text-center py-3">
                                                <h5 class="mb-0 fw-700">
                                                   <small class="text-muted mb-0">Tiempo Transcurrido</small>
                                                   <?= " " . $diff . " " . $strTime[$i] . "(s)"; ?>
                                                   
                                                </h5>
                                                 
                                            </div>
                                        </div>
                                        <div class="col-12">
                                             <div class="text-center py-3">
                                                <h5 class="mb-0 fw-700">
                                                   <small class="text-muted mb-0">Minutas Registradas</small>
                                                    <?php                                                   
                                                        echo Html::a(count($minutas_registradas), ['minutas','id' => $model->id], ['class' => 'btn btn-success btn-sm']) 
                                                    ?> 
                                                                                                    
                                                </h5>                                                
                                            </div>
                                        </div>
                                        <?php 
                                          if(Yii::$app->user->can('admin-cambiar-status')){

                                              echo Html::button('Cambiar Status', ['value' => Url::to(['editar-status', 'id' => $model->id]), 'title' => 'Cambiar Status', 'class' => 'showModalButton btn btn-info waves-effect waves-themed']);

                                          }
                                        ?>


                                        
                                    </div>
                                </div>
                                <!-- photos -->
                                   <div class="card mb-g">
            <div class="box-header with-border">
              <h3 class="box-title">Información </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-book margin-r-5"></i> Tema</strong>

              <p class="text-muted">
              <?= $model->tema ?>
              </p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Tarea</strong>

              <p class="text-muted"><?= $model->tareas ?></p>

              <hr>

              <strong><i class="fa fa-pencil margin-r-5"></i> Responsables</strong>

              <p>
               <?php foreach ($responsables as $responsable) { ?>
                <span class="label label-success"><?= $responsable->secretarias->nombre ?></span>
               <?php } ?>
              </p>

              <hr>
                <strong><i class="fa fa-pencil margin-r-5"></i> Participantes</strong>

              <p>
                <?php foreach ($participantes as $participante) { ?>
                <span class="label label-success"><?= $participante->secretarias->nombre ?></span>
               <?php } ?>
              </p>

              <hr>

              <strong><i class="fa fa-file-text-o margin-r-5"></i> Observaciones</strong>

              <p></p>
            </div>
            <!-- /.box-body -->
          </div>
                                <!-- contacts -->
<!--                                <div class="card mb-g">
                                    <div class="row row-grid no-gutters">
                                        <div class="col-12">
                                            <div class="p-3">
                                                <h2 class="mb-0 fs-xl">
                                                    Contacts
                                                </h2>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <a href="javascript:void(0);" class="text-center p-3 d-flex flex-column hover-highlight">
                                                <span class="profile-image rounded-circle d-block m-auto" style="background-image:url('/theme/img/demo/avatars/avatar-b.png'); background-size: cover;"></span>
                                                <span class="d-block text-truncate text-muted fs-xs mt-1">Oliver Kopyov</span>
                                            </a>
                                        </div>
                                        <div class="col-4">
                                            <a href="javascript:void(0);" class="text-center p-3 d-flex flex-column hover-highlight">
                                                <span class="profile-image rounded-circle d-block m-auto" style="background-image:url('/theme/img/demo/avatars/avatar-c.png'); background-size: cover;"></span>
                                                <span class="d-block text-truncate text-muted fs-xs mt-1">Sesha Gray</span>
                                            </a>
                                        </div>
                                        <div class="col-4">
                                            <a href="javascript:void(0);" class="text-center p-3 d-flex flex-column hover-highlight">
                                                <span class="profile-image rounded-circle d-block m-auto" style="background-image:url('/theme/img/demo/avatars/avatar-a.png'); background-size: cover;"></span>
                                                <span class="d-block text-truncate text-muted fs-xs mt-1">Preny Amdaney</span>
                                            </a>
                                        </div>
                                        <div class="col-4">
                                            <a href="javascript:void(0);" class="text-center p-3 d-flex flex-column hover-highlight">
                                                <span class="profile-image rounded-circle d-block m-auto" style="background-image:url('/theme/img/demo/avatars/avatar-e.png'); background-size: cover;"></span>
                                                <span class="d-block text-truncate text-muted fs-xs mt-1">Dr. John Cook PhD</span>
                                            </a>
                                        </div>
                                        <div class="col-4">
                                            <a href="javascript:void(0);" class="text-center p-3 d-flex flex-column hover-highlight">
                                                <span class="profile-image rounded-circle d-block m-auto" style="background-image:url('/theme/img/demo/avatars/avatar-h.png'); background-size: cover;"></span>
                                                <span class="d-block text-truncate text-muted fs-xs mt-1">Sarah McBrook</span>
                                            </a>
                                        </div>
                                        <div class="col-4">
                                            <a href="javascript:void(0);" class="text-center p-3 d-flex flex-column hover-highlight">
                                                <span class="profile-image rounded-circle d-block m-auto" style="background-image:url('/theme/img/demo/avatars/avatar-i.png'); background-size: cover;"></span>
                                                <span class="d-block text-truncate text-muted fs-xs mt-1">Jimmy Fellan</span>
                                            </a>
                                        </div>
                                        <div class="col-4">
                                            <a href="javascript:void(0);" class="text-center p-3 d-flex flex-column hover-highlight">
                                                <span class="profile-image rounded-circle d-block m-auto" style="background-image:url('/theme/img/demo/avatars/avatar-j.png'); background-size: cover;"></span>
                                                <span class="d-block text-truncate text-muted fs-xs mt-1">Arica Grace</span>
                                            </a>
                                        </div>
                                        <div class="col-4">
                                            <a href="javascript:void(0);" class="text-center p-3 d-flex flex-column hover-highlight">
                                                <span class="profile-image rounded-circle d-block m-auto" style="background-image:url('/theme/img/demo/avatars/avatar-k.png'); background-size: cover;"></span>
                                                <span class="d-block text-truncate text-muted fs-xs mt-1">Jim Ketty</span>
                                            </a>
                                        </div>
                                        <div class="col-4">
                                            <a href="javascript:void(0);" class="text-center p-3 d-flex flex-column hover-highlight">
                                                <span class="profile-image rounded-circle d-block m-auto" style="background-image:url('/theme/img/demo/avatars/avatar-g.png'); background-size: cover;"></span>
                                                <span class="d-block text-truncate text-muted fs-xs mt-1">Ali Grey</span>
                                            </a>
                                        </div>
                                        <div class="col-12">
                                            <div class="p-3 text-center">
                                                <a href="javascript:void(0);" class="btn-link font-weight-bold">View all</a>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>-->
                            </div>
                            <div class="col-lg-12 col-xl-9 order-lg-8 order-xl-8">
                               
                                <!-- post comment -->
                                <div class="card mb-g">
                                    <div class="tab-pane" id="timeline">
                                        <?php if($model->status == 0 || $model->status == 2 || $model->status == 3){ ?>
                                        
                                         <?= Html::button('Registrar Avance', ['value' => Url::to(['avances/nuevo-avance', 'id' => $minutas]), 'title' => 'Nuevo Seguimiento', 'class' => 'showModalButton btn btn-primary pull-right']); ?>
                                        <?php } ?>
                                        <br>
          
                                <?php
                                if($avances_registrados!=null){
                                    foreach (array_reverse($avances_registrados) as $avances) { 
    $secretaria_avance = '';
    $dia = '';
  
    $timestamp = strtotime($avances->timestamp);
    $strTime = array("segundo", "minuto", "hora", "dia", "mes", "año");
    $length = array("60", "60", "24", "30", "12", "10");
    $currentTime = date('Y-m-d H:i:s');

    $diff = time() - $timestamp;
    for ($i = 0; $diff >= $length[$i] && $i < count($length) - 1; $i++) {
        $diff = $diff / $length[$i];
    }
    $diff = round($diff);
    
    $fecha = $avances->fecha_captura;
    
    //Coveriir Fecha
    $fecha = substr($fecha, 0, 10);
    $numeroDia = date('d', strtotime($fecha));
    $dia = date('l', strtotime($fecha));
    $mes = date('F', strtotime($fecha));
    $anio = date('Y', strtotime($fecha));
    $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
    $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
    $nombredia = str_replace($dias_EN, $dias_ES, $dia);
    $meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
    $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
    $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
    //echo $nombredia." ".$numeroDia." de ".$nombreMes." de ".$anio;
    //Termina Conversion Fecha
    //Otros

    $timestamp = strtotime($avances->timestamp);       
           
    $strTime1 = array("segundo", "minuto", "hora", "dia", "mes", "año");
    $length1 = array("60","60","24","30","12","10");

    $currentTime = date('Y-m-d H:i:s');
  
                        $diff1     = time()- $timestamp;
                        for($i = 0; $diff1 >= $length1[$i] && $i < count($length1)-1; $i++) {
                        $diff1 = $diff1 / $length1[$i];
                        }

                        $diff1 = round($diff1);
                         "Hace " . $diff1 . " " . $strTime1[$i] . "(s)";
        

  //Termina Otros
                        $imgs = backend\models\ImgAvances::findOne(['avances_id' => $avances->id])->archivo;
                  

                         if($avances->imgAvances == true){
                          $img = '<a href="/avances/'.$avances->id.'/'.$imgs.'" target="_blank">Link Evidencia</a>'; 
                         } else {
                            $img = ''; 
                         }
   
              echo ' <ul class="timeline timeline-inverse">

                    <li class="time-label">
                        <span class="bg-red">
                          '.$nombredia." ".$numeroDia." de ".$nombreMes." de ".$anio.'
                        </span>
                    </li>
                    <li>
                        <i class="fa fa-comments bg-yellow"></i>

                        <div class="timeline-item">
                            <span class="time"><i class="fa fa-clock-o"></i>'. $diff . " " . $strTime[$i] . "(s)".'</span>

                            <h3 class="timeline-header"><a href="#">'.$avances->secretarias->nombre.'</a> reporto lo siguiente:</h3>
                                
                            <h3 class="timeline-header">
                                Acuerdo: '.$avances->acuerdos->acuerdo.' 
                            </h3>
                            
                            <div class="timeline-body">
                                '.$avances->comentario.' '.$img.' 
                            </div>

                        </div>
                    </li>
                    <li>
                        <i class="fa fa-clock-o bg-gray"></i>
                    </li>


                </ul>';
               }
                                }else{
                                    echo ' <i class="fa fa-comments bg-yellow"></i>';
                                }


        
    ?>
                
                
              </div>
                                    
                                    
                                </div>
                            
                            </div>
                            
                        </div>
                    </main>

