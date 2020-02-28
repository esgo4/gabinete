<style>
    .profile-data table{
        display: table;
        border-collapse: collapse;
        border:1.5px solid #adacab;
        font-size: 12.5px;
        width:100%;
    }
    .no_border tr,td{
        border:none;
        border:hidden;
        border:1.5px solid white; 
    }
    table tr:nth-child(even) { 
        background: #F4F4F4;
    }
    table tr:nth-child(odd) { 
        background: white;
    }
    .profile-data th{ 
        text-align:left;
        font-weight:normal;
        color:#990a10;
        width:110px;
        border:0.4px solid #adacab;
        height:24px;
    }
    .title {
        color:seagreen;
    }
    .profile-data td{
        border:0.4px solid #adacab;
        height:24px;
        text-align:left;
    }
    .label{
        text-align:left;
        font-weight:normal;
        color:#990a10;
        width:110px;
        height:24px;
    }
</style>

<div id="correspondencia" class="panel">
                                    <div class="panel-hdr">
                                        <h2>
                                             <span class="fw-300"><h3 class="title"><?php echo 'Información de la Minutasss'; ?></h3></span>
                                        </h2>
<!--                                        <div class="panel-toolbar">
                                            <button class="btn btn-panel waves-effect waves-themed" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                                            <button class="btn btn-panel waves-effect waves-themed" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                                            <button class="btn btn-panel waves-effect waves-themed" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                                        </div>-->
                                    </div>
                                    <div class="panel-container show">
                                   <!------------Start Employee Details Block---------------->

 <table class="table table-bordered">
    <tr>
        <td  rowspan='5' width="135px" align="center" style="border:none">
            <img src="/logo.png" height="147px" width="350px" class="photo" style="margin-right:18px"/>
        </td>

        <td  class="label" style="border:1.5px solid white;width:150px"><b><?php echo 'Folio'; ?><b></td>
                    <td><?php echo $model->folio; ?></td>
                    </tr>
                    <tr style="background:none">
                        <td class="label" style="border:1.5px solid white;"><b><?php echo 'Lugar'; ?></b></td>
                        <td><?php echo $model->lugar; ?></td>
                    </tr>
                    <tr>
                        <td class="label" style="border:1.5px solid white;"><b><?php echo 'Fecha'; ?></b></td>
                        <td><?php echo $model->fecha; ?>
                    </tr>
                     <tr style="background:none">
                        <td class="label" style="border:1.5px solid white;"><b><?php echo 'Proyecto Bandera'; ?></b></td>
                                    <td><?php $proyectosb = \backend\models\Mproyectos::find()->where(['seguimiento_id' => $model->id])->all(); 
 foreach ($proyectosb as $bandera){
     echo $bandera->mProyectosEstrategicos->nombre;
 }
                                    ?></td>
                                    </tr>
                    <tr style="background:none">
                        <td class="label" style="border:1.5px solid white;"><b><?php echo 'Tema'; ?><b></td>
                                    <td><?php echo $model->tema; ?></td>
                                    </tr>
                                    
                                    </table>

                                    <!----------Start employee personal information--------------> 
                                    <div class="profile-data">
                                        <h4 class="title"><?php echo 'Acuerdos'; ?></h4>
                         <?= \yii\bootstrap\Html::button('Nuevo Acuerdos', ['value' => yii\helpers\Url::to(['acuerdos/nuevo-acuerdo', 'id' => $model->id]), 'title' => 'Cambiar Status', 'class' => 'showModalButton btn btn-info waves-effect waves-themed']); ?>

                                        <table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">Acuerdos</th>
      <th scope="col">Fecha</th>
      <th scope="col">Secretaria</th>
      <th scope="col">Plazo</th>
      <th scope="col">Termino</th>
    </tr>
  </thead>
  <tbody>
   <?php
   $acuerdos = \backend\models\Acuerdos::find()->where(['minutas_id' => $model->id])->all();
   foreach ($acuerdos as $acuerdo){
       
  
   ?>
    <tr>
      <th scope="row"><?= $acuerdo->acuerdo ?></th>
      <td><?= $acuerdo->fecha_inicio ?></td>
      <td><?= $acuerdo->secretaria->nombre ?></td>
      <td>pendiente</td>
      <td><?= $acuerdo->fecha_termino ?></td>
    </tr>
<?php  } ?>
   
  </tbody>
</table>
                                   
                                    </div>

                                    </div>
                                </div>
