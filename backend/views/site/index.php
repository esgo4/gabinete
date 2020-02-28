<?php

/* @var $this yii\web\View */

$this->title = Yii::$app->name;
?>
<?php
  if(Yii::$app->user->can('index')){
?>
   <!-- BEGIN Page Content -->
                    <!-- the #js-page-content id is needed for some plugins to initialize -->
               
                        <ol class="breadcrumb page-breadcrumb">
                            <li class="breadcrumb-item"><a href="/index.php">Inicio</a></li>
                            <li class="breadcrumb-item">Tablero </li>
                       
                            <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
                        </ol>
                        <div class="subheader">
                            <h1 class="subheader-title">
                                <i class='subheader-icon fal fa-chart-area'></i> Panel de <span class='fw-300'>Administrador</span>
                            </h1>
<!--                            <div class="subheader-block d-lg-flex align-items-center">
                                <div class="d-inline-flex flex-column justify-content-center mr-3">
                                    <span class="fw-300 fs-xs d-block opacity-50">
                                        <small>EXPENSES</small>
                                    </span>
                                    <span class="fw-500 fs-xl d-block color-primary-500">
                                        $47,000
                                    </span>
                                </div>
                                <span class="sparklines hidden-lg-down" sparkType="bar" sparkBarColor="#886ab5" sparkHeight="32px" sparkBarWidth="5px" values="3,4,3,6,7,3,3,6,2,6,4"></span>
                            </div>
                            <div class="subheader-block d-lg-flex align-items-center border-faded border-right-0 border-top-0 border-bottom-0 ml-3 pl-3">
                                <div class="d-inline-flex flex-column justify-content-center mr-3">
                                    <span class="fw-300 fs-xs d-block opacity-50">
                                        <small>MY PROFITS</small>
                                    </span>
                                    <span class="fw-500 fs-xl d-block color-danger-500">
                                        $38,500
                                    </span>
                                </div>
                                <span class="sparklines hidden-lg-down" sparkType="bar" sparkBarColor="#fe6bb0" sparkHeight="32px" sparkBarWidth="5px" values="1,4,3,6,5,3,9,6,5,9,7"></span>
                            </div>-->
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div id="panel-1" class="panel panel-locked" data-panel-lock="false" data-panel-close="false" data-panel-fullscreen="false" data-panel-collapsed="false" data-panel-color="false" data-panel-locked="false" data-panel-refresh="false" data-panel-reset="false">
                                    <div class="panel-hdr">
                                        <h2>
                                            Informe mensual de seguimientos
                                        </h2>
                                        <div class="panel-toolbar pr-3 align-self-end">
                                           
                                        </div>
                                    </div>
                                    <div class="panel-container show">
                                        <div class="panel-content border-faded border-left-0 border-right-0 border-top-0">
                                            <div class="row no-gutters">
                                                <div class="col-lg-7 col-xl-8">
                                                    <div class="position-relative">
                                                        <div class="custom-control custom-switch position-absolute pos-top pos-left ml-5 mt-3 z-index-cloud">
                                                            <input type="checkbox" class="custom-control-input" id="start_interval">
<!--                                                            <label class="custom-control-label" for="start_interval">Live Update</label>-->
                                                        </div>
                                                         <div id="graficamensual">
                                                        <canvas style="width:100%; height:300px;"></canvas>
                                                    </div>
<!--                                                        <div id="graficamensual" style="height:242px"></div>-->
                                                    </div>
                                                </div>
                                                <div class="col-lg-5 col-xl-4 pl-lg-3">
                                                    <div class="d-flex mt-2">
                                                        Completados
                                                        <span class="d-inline-block ml-auto"><?= $completado ?> / <?= $totales ?></span>
                                                    </div>
                                                    <div class="progress progress-sm mb-3">
                                                        <?php  
                       if ($completado == 0) {
                           $porcentajecompletado = 0;
                       } else {
                           $porcentajecompletado = $completado * 100 / $totales;
                           $restantes = 100 - $porcentajecompletado;
                       }
                       ?>
                                                        <div class="progress-bar bg-fusion-400" role="progressbar" style="width: <?= $porcentajecompletado?>%;" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    <div class="d-flex">
                                                        En Proceso
                                                        <span class="d-inline-block ml-auto"><?= $enproceso ?> / <?= $totales ?> </span>
                                                    </div>
                                                    <div class="progress progress-sm mb-3">
                                                        <?php  
                       if ($enproceso == 0) {
                           $porcentajeenproceso = 0;
                       } else {
                           $porcentajeenproceso = $enproceso * 100 / $totales;
                           $restantes = 100 - $porcentajeenproceso;
                       }
                       ?>
                                                        <div class="progress-bar bg-success-500" role="progressbar" style="width: <?= $porcentajeenproceso ?>%;" aria-valuenow="34" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    <div class="d-flex">
                                                        Vencidos
                                                        <span class="d-inline-block ml-auto"><?= $vencido ?> / <?= $totales ?></span>
                                                    </div>
                                                    <div class="progress progress-sm mb-3">
                                                         <?php  
                       if ($vencido == 0) {
                           $porcentajevencido = 0;
                       } else {
                           $porcentajevencido = $vencido * 100 / $totales;
                           $restantes = 100 - $porcentajevencido;
                       }
                       ?>
                                                        <div class="progress-bar bg-info-400" role="progressbar" style="width: <?= $porcentajevencido ?>%;" aria-valuenow="77" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    <div class="d-flex">
                                                        Sin Atención
                                                        <span class="d-inline-block ml-auto"><?= $sinatencion ?> / <?= $totales ?></span>
                                                    </div>
                                                    <div class="progress progress-sm mb-g">
                                                         <?php  
                       if ($sinatencion == 0) {
                           $porcentajesinatencion = 0;
                       } else {
                           $porcentajesinatencion = $sinatencion * 100 / $totales;
                           $restantes = 100 - $porcentajesinatencion;
                       }
                       ?>
                                                        <div class="progress-bar bg-primary-300" role="progressbar" style="width: <?= $porcentajesinatencion ?>%;" aria-valuenow="84" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
<!--                                                    <div class="row no-gutters">
                                                        <div class="col-6 pr-1">
                                                            <a href="#" class="btn btn-default btn-block">Generate PDF</a>
                                                        </div>
                                                        <div class="col-6 pl-1">
                                                            <a href="#" class="btn btn-default btn-block">Report a Bug</a>
                                                        </div>
                                                    </div>-->
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div id="panel-2" class="panel" data-panel-fullscreen="false">
                                    <div class="panel-hdr">
                                        <h2>
                                           Últimos Seguimientos
                                        </h2>
                                    </div>
                                    <div class="panel-container show">
                                        <div class="panel-content p-0">
                                            <div class="d-flex flex-column">
                                           <div class="frame-wrap">
                                                <table class="table m-0">
                                                    <thead class="thead-themed">
                                                        <tr>
                                                            <th>Folio</th>
                                                            <th>Tema</th>
                                                            <th>Status</th>
                                                            <th>Fecha</th>
                                                             <th>Tiempo Transcurrido</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                     <?php 
                  $dseguimiento = backend\models\Seguimiento::find()->limit(8)->all();
                  
                  foreach ($dseguimiento as $seguimiento){
                  ?>
                                                        <tr>
                                                            <th scope="row"><?= $seguimiento->folio ?></th>
                                                            <td><?= $seguimiento->tema ?></td>
                                                            <?php
                    if ($seguimiento->status == 0) {
                        echo '<td><span class="label label-warning">Vencido</span></td>';
                        } elseif ($seguimiento->status == 1) {
                            echo '<td><span class="label label-success">Completado</span></td>';
                        } elseif ($seguimiento->status == 2) {
                            echo '<td><span class="label label-info">En Proceso</span></td>';
                        } elseif ($seguimiento->status == 3) {
                            echo '<td><span class="label label-danger">Sin Atención</span></td>';
                        }
                        ?>
                                                            <td><?= $seguimiento->fecha_captura ?></td>
                                                            <td><?php 
                        $timestamp = strtotime($seguimiento->timestamp);       
           
           $strTime = array("segundo", "minuto", "hora", "dia", "mes", "año");
           $length = array("60","60","24","30","12","10");

           $currentTime = date('Y-m-d H:i:s');


    
                        $diff     = time()- $timestamp;
                        for($i = 0; $diff >= $length[$i] && $i < count($length)-1; $i++) {
                        $diff = $diff / $length[$i];
                        }

                        $diff = round($diff);
                         
        
                      ?><?= "Hace " . $diff . " " . $strTime[$i] . "(s)"; ?></td>
                                                        </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                               
                                                    
                                                 
                                            
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div id="panel-3" class="panel">
                                    <div class="panel-hdr">
                                        <h2 class="">Calendario</h2>
                                    </div>
                                    <div class="panel-container show">
                                        <div class="panel-content">
                              <div id='calendars'></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div id="panel-6" class="panel">
                                    <div class="panel-hdr">
                                        <h2>Grafica por avance </h2>
                                    </div>
                                    <div class="panel-container show">
                                        <div class="panel-content p-0 mb-g">
<!--                                            <div class="alert alert-success alert-dismissible fade show border-faded border-left-0 border-right-0 border-top-0 rounded-0 m-0" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                                </button>
                                                <strong>Last update was on <span class="js-get-date"></span></strong> - Your logs are all up to date.
                                            </div>-->
                                        </div>
                                        <div class="panel-content">
                                            <div class="row  mb-g">
                                                <div class="col-md-6 d-flex align-items-center">
                                                     <div id="graficasavance">
                                                        <canvas style="width:100%; height:300px;"></canvas>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-5 mr-lg-auto">
                                                    <div class="d-flex mt-2 mb-1 fs-xs text-success">
                                                        Completado
                                                    </div>
                                                    <div class="progress progress-xs mb-3">
                                                        <div class="progress-bar" role="progressbar" style="width:0%;" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    <div class="d-flex mt-2 mb-1 fs-xs text-default">
                                                        En Proceso
                                                    </div>
                                                    <div class="progress progress-xs mb-3">
                                                        <div class="progress-bar bg-info-500" role="progressbar" style="width: 0%;" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    <div class="d-flex mt-2 mb-1 fs-xs text-danger">
                                                        Vencidos
                                                    </div>
                                                    <div class="progress progress-xs mb-3">
                                                        <div class="progress-bar bg-warning-500" role="progressbar" style="width: 0%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    <div class="d-flex mt-2 mb-1 fs-xs text-warning">
                                                        Sin Atención 
                                                    </div>
                                                  
                                                    <div class="progress progress-xs mb-3">
                                                        <div class="progress-bar bg-fusion-500" role="progressbar" style="width: 0%;" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
<!--                                <div id="panel-4" class="panel">
                                    <div class="panel-hdr">
                                        <h2>Bird's Eyes</h2>
                                    </div>
                                    <div class="panel-container show">
                                        <div class="panel-content jqvmap-bg-ocean p-0" style="height: 330px;">
                                            <div id="vector-map" class="w-100 h-100 p-4"></div>
                                        </div>
                                        <div class="panel-content jqvmap-bg-ocean">
                                            <div class="d-flex align-items-center">
                                                <img class="d-inline-block js-jqvmap-flag mr-3 border-faded" alt="flag" src="https://lipis.github.io/flag-icon-css/flags/4x3/us.svg" style="width:55px; height: auto;">
                                                <h4 class="d-inline-block fw-300 m-0 text-muted fs-lg">
                                                    Showcasing information:
                                                    <small class="js-jqvmap-country mb-0 fw-500 text-dark">United States of America - $3,760,125.00</small>
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="panel-5" class="panel">
                                    <div class="panel-hdr">
                                        <h2>Subscriptions Hourly</h2>
                                    </div>
                                    <div class="panel-container show">
                                        <div class="panel-content">
                                            <h5>Subscription Views / hour</h5>
                                            <div id="flotBar1" style="width: 100%; height: 160px;"></div>
                                        </div>
                                    </div>
                                </div>
                                <div id="panel-6" class="panel">
                                    <div class="panel-hdr">
                                        <h2>Secession Scale </h2>
                                    </div>
                                    <div class="panel-container show">
                                        <div class="panel-content p-0 mb-g">
                                            <div class="alert alert-success alert-dismissible fade show border-faded border-left-0 border-right-0 border-top-0 rounded-0 m-0" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                                </button>
                                                <strong>Last update was on <span class="js-get-date"></span></strong> - Your logs are all up to date.
                                            </div>
                                        </div>
                                        <div class="panel-content">
                                            <div class="row  mb-g">
                                                <div class="col-md-6 d-flex align-items-center">
                                                    <div id="flotPie" class="w-100" style="height:250px"></div>
                                                </div>
                                                <div class="col-md-6 col-lg-5 mr-lg-auto">
                                                    <div class="d-flex mt-2 mb-1 fs-xs text-primary">
                                                        Current Usage
                                                    </div>
                                                    <div class="progress progress-xs mb-3">
                                                        <div class="progress-bar" role="progressbar" style="width: 70%;" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    <div class="d-flex mt-2 mb-1 fs-xs text-info">
                                                        Net Usage
                                                    </div>
                                                    <div class="progress progress-xs mb-3">
                                                        <div class="progress-bar bg-info-500" role="progressbar" style="width: 30%;" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    <div class="d-flex mt-2 mb-1 fs-xs text-warning">
                                                        Users blocked
                                                    </div>
                                                    <div class="progress progress-xs mb-3">
                                                        <div class="progress-bar bg-warning-500" role="progressbar" style="width: 40%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    <div class="d-flex mt-2 mb-1 fs-xs text-danger">
                                                        Custom cases
                                                    </div>
                                                    <div class="progress progress-xs mb-3">
                                                        <div class="progress-bar bg-danger-500" role="progressbar" style="width: 15%;" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    <div class="d-flex mt-2 mb-1 fs-xs text-success">
                                                        Test logs
                                                    </div>
                                                    <div class="progress progress-xs mb-3">
                                                        <div class="progress-bar bg-success-500" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    <div class="d-flex mt-2 mb-1 fs-xs text-dark">
                                                        Uptime records
                                                    </div>
                                                    <div class="progress progress-xs mb-3">
                                                        <div class="progress-bar bg-fusion-500" role="progressbar" style="width: 10%;" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>-->
                            </div>
                        </div>
                  
                    <!-- this overlay is activated only when mobile menu is triggered -->
                    <div class="page-content-overlay" data-action="toggle" data-class="mobile-nav-on"></div> <!-- END Page Content -->
                    <!-- BEGIN Page Footer -->
                    <footer class="page-footer" role="contentinfo">
                        <div class="d-flex align-items-center flex-1 text-muted">
                            <span class="hidden-md-down fw-700">2019 © SmartAdmin by&nbsp;<a href='https://www.gotbootstrap.com' class='text-primary fw-500' title='gotbootstrap.com' target='_blank'>gotbootstrap.com</a></span>
                        </div>
                        <div>
                            <ul class="list-table m-0">
                                <li><a href="intel_introduction.html" class="text-secondary fw-700">About</a></li>
                                <li class="pl-3"><a href="info_app_licensing.html" class="text-secondary fw-700">License</a></li>
                                <li class="pl-3"><a href="info_app_docs.html" class="text-secondary fw-700">Documentation</a></li>
                                <li class="pl-3 fs-xl"><a href="https://wrapbootstrap.com/user/MyOrange" class="text-secondary" target="_blank"><i class="fal fa-question-circle" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </footer>
                    <!-- END Page Footer -->
                    <!-- BEGIN Shortcuts -->
                    <div class="modal fade modal-backdrop-transparent" id="modal-shortcut" tabindex="-1" role="dialog" aria-labelledby="modal-shortcut" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-top modal-transparent" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <ul class="app-list w-auto h-auto p-0 text-left">
                                        <li>
                                            <a href="intel_introduction.html" class="app-list-item text-white border-0 m-0">
                                                <div class="icon-stack">
                                                    <i class="base base-7 icon-stack-3x opacity-100 color-primary-500 "></i>
                                                    <i class="base base-7 icon-stack-2x opacity-100 color-primary-300 "></i>
                                                    <i class="fal fa-home icon-stack-1x opacity-100 color-white"></i>
                                                </div>
                                                <span class="app-list-name">
                                                    Home
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="page_inbox_general.html" class="app-list-item text-white border-0 m-0">
                                                <div class="icon-stack">
                                                    <i class="base base-7 icon-stack-3x opacity-100 color-success-500 "></i>
                                                    <i class="base base-7 icon-stack-2x opacity-100 color-success-300 "></i>
                                                    <i class="ni ni-envelope icon-stack-1x text-white"></i>
                                                </div>
                                                <span class="app-list-name">
                                                    Inbox
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="intel_introduction.html" class="app-list-item text-white border-0 m-0">
                                                <div class="icon-stack">
                                                    <i class="base base-7 icon-stack-2x opacity-100 color-primary-300 "></i>
                                                    <i class="fal fa-plus icon-stack-1x opacity-100 color-white"></i>
                                                </div>
                                                <span class="app-list-name">
                                                    Add More
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END Shortcuts -->
                    <!-- BEGIN Color profile -->
                    <!-- this area is hidden and will not be seen on screens or screen readers -->
                    <!-- we use this only for CSS color refernce for JS stuff -->
                    <p id="js-color-profile" class="d-none">
                        <span class="color-primary-50"></span>
                        <span class="color-primary-100"></span>
                        <span class="color-primary-200"></span>
                        <span class="color-primary-300"></span>
                        <span class="color-primary-400"></span>
                        <span class="color-primary-500"></span>
                        <span class="color-primary-600"></span>
                        <span class="color-primary-700"></span>
                        <span class="color-primary-800"></span>
                        <span class="color-primary-900"></span>
                        <span class="color-info-50"></span>
                        <span class="color-info-100"></span>
                        <span class="color-info-200"></span>
                        <span class="color-info-300"></span>
                        <span class="color-info-400"></span>
                        <span class="color-info-500"></span>
                        <span class="color-info-600"></span>
                        <span class="color-info-700"></span>
                        <span class="color-info-800"></span>
                        <span class="color-info-900"></span>
                        <span class="color-danger-50"></span>
                        <span class="color-danger-100"></span>
                        <span class="color-danger-200"></span>
                        <span class="color-danger-300"></span>
                        <span class="color-danger-400"></span>
                        <span class="color-danger-500"></span>
                        <span class="color-danger-600"></span>
                        <span class="color-danger-700"></span>
                        <span class="color-danger-800"></span>
                        <span class="color-danger-900"></span>
                        <span class="color-warning-50"></span>
                        <span class="color-warning-100"></span>
                        <span class="color-warning-200"></span>
                        <span class="color-warning-300"></span>
                        <span class="color-warning-400"></span>
                        <span class="color-warning-500"></span>
                        <span class="color-warning-600"></span>
                        <span class="color-warning-700"></span>
                        <span class="color-warning-800"></span>
                        <span class="color-warning-900"></span>
                        <span class="color-success-50"></span>
                        <span class="color-success-100"></span>
                        <span class="color-success-200"></span>
                        <span class="color-success-300"></span>
                        <span class="color-success-400"></span>
                        <span class="color-success-500"></span>
                        <span class="color-success-600"></span>
                        <span class="color-success-700"></span>
                        <span class="color-success-800"></span>
                        <span class="color-success-900"></span>
                        <span class="color-fusion-50"></span>
                        <span class="color-fusion-100"></span>
                        <span class="color-fusion-200"></span>
                        <span class="color-fusion-300"></span>
                        <span class="color-fusion-400"></span>
                        <span class="color-fusion-500"></span>
                        <span class="color-fusion-600"></span>
                        <span class="color-fusion-700"></span>
                        <span class="color-fusion-800"></span>
                        <span class="color-fusion-900"></span>
                    </p>
                    <!-- END Color profile -->
     <link href='/fullcalendar/core/main.css' rel='stylesheet' />
    <link href='/fullcalendar/daygrid/main.css' rel='stylesheet' />

    <script src='/fullcalendar/core/main.js'></script>
    <script src='/fullcalendar/daygrid/main.js'></script>
 <?php 
$this->registerJs( <<< EOT_JS_CODE

  /* line chart */
            var lineChart = function()
            {
                var config = {
                    type: 'line',
                    data:
                    {
                        labels: $dias,
                        datasets: [
                        {
                            label: "Seguimientos",
                            borderColor: color.success._500,
                            pointBackgroundColor: color.success._700,
                            pointBorderColor: 'rgba(0, 0, 0, 0)',
                            pointBorderWidth: 4,
                            borderWidth: 5,
                            pointRadius: 3,
                            pointHoverRadius: 4,
                            data: $dia,
                            fill: false
                        }]
                    },
                    options:
                    {
                        responsive: true,
                        title:
                        {
                            display: false,
                            text: 'Line Chart'
                        },
                        tooltips:
                        {
                            mode: 'index',
                            intersect: false,
                        },
                        hover:
                        {
                            mode: 'nearest',
                            intersect: true
                        },
                        scales:
                        {
                            xAxes: [
                            {
                                display: true,
                                scaleLabel:
                                {
                                    display: false,
                                    labelString: '6 months forecast'
                                },
                                gridLines:
                                {
                                    display: true,
                                    color: "#f2f2f2"
                                },
                                ticks:
                                {
                                    beginAtZero: true,
                                    fontSize: 11
                                }
                            }],
                            yAxes: [
                            {
                                display: true,
                                scaleLabel:
                                {
                                    display: false,
                                    labelString: 'Profit margin (approx)'
                                },
                                gridLines:
                                {
                                    display: true,
                                    color: "#f2f2f2"
                                },
                                ticks:
                                {
                                    beginAtZero: true,
                                    fontSize: 11
                                }
                            }]
                        }
                    }
                };
                new Chart($("#graficamensual > canvas").get(0).getContext("2d"), config);
            }
            /* line chart -- end */
        
           /* doughnut chart */
            var doughnutChart = function()
            {
                var config = {
                    type: 'doughnut',
                    data:
                    {
                        datasets: [
                        {
                            data: [
                                $completado,
                                $enproceso,
                                $vencido,
                                $sinatencion,
                            
                            ],
                            backgroundColor: [
                                "#1dc9b7",
                                "#f5f5f5",
                                "#fd3995",
                                "#ffc241",
                                
                            ],
                            label: 'My dataset' // for legend


                        }],
                        labels: [
                            "Completado",
                            "En Proceso",
                            "Vencidos",
                            "Sin Atención"
                      
                        ]
                    },
                    options:
                    {
                        responsive: true,
                        legend:
                        {
                            display: true,
                            position: 'bottom',
                        }
                    }
                };
                new Chart($("#graficasavance > canvas").get(0).getContext("2d"), config);
            }
            /* doughnut chart -- end */
        
     
        
        
        
        
  lineChart();
         doughnutChart();
EOT_JS_CODE
);
?>
                  <script>

      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendars');

        var calendar = new FullCalendar.Calendar(calendarEl, {
           plugins: ['dayGrid', 'list', 'timeGrid', 'interaction', 'bootstrap'],
            themeSystem: 'bootstrap',
                    timeZone: 'UTC',
                    locale: 'es',
                    dateAlignment: "month", //week, month
                     buttonText:
                    {
                        today: 'Hoy',
                        month: 'Mes',
                        week: 'Semena',
                        day: 'Día',
                        list: 'Lista'
                    },
                     header:
                    {
                        left: 'prev,next today addEventButton',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                    },
                     footer:
                    {
                        left: '',
                        center: '',
                        right: ''
                    },
                    // editable: true,
                    eventLimit: true, // allow "more" link when too many events
                    views:
                    {
                        sevenDays:
                        {
                            type: 'agenda',
                            buttonText: '7 Days',
                            visibleRange: function(currentDate)
                            {
                                return {
                                    start: currentDate.clone().subtract(2, 'days'),
                                    end: currentDate.clone().add(5, 'days'),
                                };
                            },
                            duration:
                            {
                                days: 7
                            },
                            dateIncrement:
                            {
                                days: 1
                            },
                        },
                    },
                    
                    events: [
//                          {
//      id: 'a',
//      title: 'my event',
//      start: '2019-11-13'
//    },
 <?php 
     $calendario = backend\models\Seguimiento::find()->all();
        
        
        foreach ($calendario as $eventos){ ?>
            
 
                    {
    
                        title: '<?= $eventos->tema ?>',
                        start: '<?= $eventos->fecha_inicio ?>',
                        description: 'This is a test description', //this is currently bugged: https://github.com/fullcalendar/fullcalendar/issues/1795
                        className: "border-warning bg-warning text-dark"
                    },
          <?php } ?>
                        ],
        });

        calendar.render();
      });

    </script>
     
  <?php } ?>