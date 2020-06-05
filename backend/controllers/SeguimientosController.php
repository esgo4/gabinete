<?php

namespace backend\controllers;

use Yii;
use backend\models\Seguimientos;
use backend\models\SeguimientosBuscar;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SeguimientosController implements the CRUD actions for Seguimientos model.
 */
class SeguimientosController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Seguimientos models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SeguimientosBuscar();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Seguimientos model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
     public function actionView($id) { // id de minuta para jalar avances
         
           //$model = $this->findModel($id); // Model del seguimiento         
    
           $minutas = \backend\models\Minutas::findOne(['id' => $id]); // btn avances --  minuta
           
           $model = \backend\models\Seguimientos::findOne(['id' => $minutas->seguimientos_id]);  // Model del seguimiento  
         
           //$acuerdos = \backend\models\Acuerdos::findOne(['minutas_id' => $minutas])->id; // 

           //$avances = \backend\models\Avances::find()->where(['acuerdos_id' => $acuerdos])->all();
    
           $responsables = \backend\models\Responsables::find()->where(['seguimientos_id' => $model->id])->all();
           $participantes = \backend\models\Participantes::find()->where(['seguimientos_id' => $model->id])->all();
           
           $minutas_registradas = \backend\models\Minutas::find()->where(['seguimientos_id' => $model->id])->all();          
           $avances_registrados = \backend\models\Avances::find()->where(['minuta_id' => $id])->all();
           
        return $this->render('view', [
                    'model' => $model,
                    //'avances_secretaria' => $avances,
                    'responsables' => $responsables,
                    'participantes' => $participantes,
                    'minutas' => $minutas,
            //'acuerdos'=>$acuerdos,
            'avances_registrados' =>  $avances_registrados,
            'minutas_registradas' => $minutas_registradas,
        ]);
    }
    
    public function actionMinutas($id) { // id de seguimiento
         
           $model = $this->findModel($id);
    
           //$minutas = 0;//;\backend\models\Minutas::findOne(['seguimientos_id' => $id])->id; // 1
         
           //$acuerdos = 0;//\backend\models\Acuerdos::findOne(['minutas_id' => $minutas])->id; // 2 acuerdos, 1,2

           //$avances = 0;//\backend\models\Avances::find()->where(['acuerdos_id' => $acuerdos])->all();
    
           $responsables = \backend\models\Responsables::find()->where(['seguimientos_id' => $id])->all();
           $participantes = \backend\models\Participantes::find()->where(['seguimientos_id' => $id])->all();
           
           $minutas_registradas = \backend\models\Minutas::find()->where(['seguimientos_id' => $id])->all();
           $avances_registrados = \backend\models\Avances::find()->where(['minuta_id' => $id])->all();
           


        return $this->render('minutas', [
                    'model' => $this->findModel($id),
                    //'avances_secretaria' => $avances,
                    'responsables' => $responsables,
                    'participantes' => $participantes,
                    //'minutas' => $minutas,
                    //'acuerdos'=>$acuerdos,
            'minutas_registradas' => $minutas_registradas,
            'avances_registrados' =>  $avances_registrados,
        ]);
    }

    /**
     * Creates a new Seguimientos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Seguimientos();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
    
    public function actionNuevoSeguimiento() {
          $model = new Seguimientos(['scenario' => Seguimientos::SCENARIO_NUEVO_SEGUIMIENTO]);
       
        $secretarias_responsables = \yii\helpers\ArrayHelper::map(\backend\models\Secretarias::find()->where(['activo' => '1'])->all(), 'id', 'nombre');
        $secretarias_participantes = \yii\helpers\ArrayHelper::map(\backend\models\Secretarias::find()->where(['activo' => '1'])->all(), 'id', 'nombre');

        $model->fecha_inicio = date('Y-m-d');
        $model->leido = '0';
        if ($model->load(Yii::$app->request->post())) {

            $model->user_id = \Yii::$app->user->identity->id;
            $model->status = 2;
            $model->fecha_captura = date('Y-m-d');
            $model->save();
            $model->folio = $model->id . '-' . date('Y-m-d');
            $model->save();

            //Guardo Secretaria Responsable 
            if ($model->secretaria_responsable == true) {
                foreach ($model->secretaria_responsable as $responsable) {
                    $modelseguimiento = new \backend\models\Responsables();
                    $modelseguimiento->seguimientos_id = $model->id;
                    $modelseguimiento->secretarias_id = $responsable;
                    $modelseguimiento->save();
                    
//                    //Genero Notificaciones Para Responsables
//                     $modelnotificaciones = new \app\models\Notificaciones();
//                     $modelnotificaciones->seguimientos_id = $model->id;
//                     $modelnotificaciones->secretarias_id = $responsable;
//                     $modelnotificaciones->leido = '0';
//                     $modelnotificaciones->fecha_captura = date('Y-m-d');
//                     $modelnotificaciones->save();
                }
                
            }

            //Guardo Secretaria Participante 
            if ($model->secretaria_participante == true) {
                foreach ($model->secretaria_participante as $participante) {
                    $modelseguimiento = new \backend\models\Participantes();
                    $modelseguimiento->seguimientos_id = $model->id;
                    $modelseguimiento->secretarias_id = $participante;
                    $modelseguimiento->save();
                    
                    //Genero Notificaciones Para Participantes
//                     $modelnotificaciones = new \app\models\Notificaciones();
//                     $modelnotificaciones->seguimientos_id = $model->id;
//                     $modelnotificaciones->secretarias_id = $participante;
//                     $modelnotificaciones->leido = '0';
//                     $modelnotificaciones->fecha_captura = date('Y-m-d');
//                     $modelnotificaciones->save();
                }
            }
            
  

            return $this->redirect(['index']);
        }

        return $this->renderAjax('nuevo/nuevo-seguimiento', [
                    'model' => $model,
                    'secretarias_responsables' => $secretarias_responsables,
                    'secretarias_participantes' => $secretarias_participantes,
        ]);
    }
    
     public function actionEditarSeguimiento($id)
    {
        $model = $this->findModel($id);
        $model->scenario = Seguimientos::SCENARIO_UPDATE_SEGUIMIENTO;
            
            $idresponsable = array();
            $nombreresponsable = array();
            $valorresponsable = array();
            foreach($model->responsables as $responsables){
            $idresponsable[] = $responsables->secretarias_id;
            $nombreresponsable[] = $responsables->secretarias->nombre;
            $valorresponsable[$responsables->secretarias_id] = $responsables->secretarias->nombre;
            }

            //Participantes
             $idparticipante = array();
            $nombreparticipante = array();
            $valorparticipante = array();
            foreach($model->participantes as $participantes){
            $idparticipante[] = $participantes->secretarias_id;
            $nombreparticipante[] = $participantes->secretarias->nombre;
            $valorparticipante[$participantes->secretarias_id] = $participantes->secretarias->nombre;
            }

  
           

        
        if ($model->load(Yii::$app->request->post()) ) {
            //Participantes
            $secretarias_r = array();
            $secretarias_r_actuales = array();
            $existentesr = \backend\models\Responsables::find()->where(['seguimientos_id'=>$model->id])->all();
            foreach ($existentesr as $exis){
               $secretarias_r_actuales[] = $exis->secretarias_id;
            }
            
            foreach ($model->secretaria_responsable as $responsable){
            $modelresponsable = new \backend\models\Responsables();
            $modelresponsable->seguimientos_id = $model->id;
            $modelresponsable->secretarias_id = $responsable;
            $modelresponsable->save();
            $secretarias_r[]= $responsable;
            } 
            
            $resultado = array_diff($secretarias_r_actuales, $secretarias_r);
            
            if($secretarias_r_actuales != $secretarias_r){
             \Yii::$app->db->createCommand()->delete('responsables', ['seguimientos_id' => $model->id, 'secretarias_id' => $resultado])->execute();  
            }
            //Termina Participantes
            
            //Responsables
            $secretarias_p = array();
            $secretarias_p_actuales = array();
            $existentesp = \backend\models\Participantes::find()->where(['seguimientos_id'=>$model->id])->all();
            foreach ($existentesp as $exis){
               $secretarias_p_actuales[] = $exis->secretarias_id;
            }

            if($model->secretaria_participante == true){

                    foreach ($model->secretaria_participante as $participante){
            $modelparticipante = new \backend\models\Participantes();
            $modelparticipante->seguimientos_id = $model->id;
            $modelparticipante->secretarias_id = $participante;
            $modelparticipante->save();
            $secretarias_p[]= $participante;
            } 

            }
            
            
            
            $resultador = array_diff($secretarias_p_actuales, $secretarias_p);
            
            if($secretarias_p_actuales != $secretarias_p){
             \Yii::$app->db->createCommand()->delete('participantes', ['seguimientos_id' => $model->id, 'secretarias_id' => $resultador])->execute();  
            }
            //Termina Responsables

            $model->save();
           
            
     return $this->redirect(['index']);
            //return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->renderAjax('editar/editar-seguimiento', [
            'model' => $model,
            'idresponsable' => $idresponsable,
            'nombreresponsable' =>  $nombreresponsable,
            'valorresponsable' => $valorresponsable,
            'idparticipante' => $idparticipante,
            'nombreparticipante' =>  $nombreparticipante,
            'valorparticipante' => $valorparticipante,
        ]);
        
    }

    /**
     * Updates an existing Seguimientos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Seguimientos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Seguimientos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Seguimientos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Seguimientos::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
    public function actionResponsables($dependencia = '', $q = null) {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        //$out = ['results' => ['id' => '', 'text' => '']];
        $query = \backend\models\Secretarias::find()->select(['id', 'text' => 'nombre']);
        if ($dependencia != '') {
            $recibido = explode(',', $dependencia);
            $query->where(['not in', 'id', $recibido]);
        }
        if ($q != null) {
            $query->where(['like', 'nombre', $q]);
        }
        if ($q != null and $dependencia != '') {
            $query->where(['not in', 'id', $recibido]);
            $query->andWhere(['like', 'nombre', $q]);
        }
        
        
        $out['results'] = $query->asArray()->all();
        
        
        
        return $out;
    }

    public function actionParticipantes($dependencia = '', $q = null) {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        //$out = ['results' => ['id' => '', 'text' => '']];
        $query = \backend\models\Secretarias::find()->select(['id', 'text' => 'nombre']);
        if ($dependencia != '') {
            $recibido = explode(',', $dependencia);
            $query->where(['not in', 'id', $recibido]);
        }
        if ($q != null) {
            $query->where(['like', 'nombre', $q]);
        }
        if ($q != null and $dependencia != '') {
            $query->where(['not in', 'id', $recibido]);
            $query->andWhere(['like', 'nombre', $q]);
        }
        $out['results'] = $query->asArray()->all();
        return $out;
    }
    
    public function actionGenerarMinuta($id) { // id seguimiento
        $minutas = new \backend\models\Minutas();
        $minutas->seguimientos_id = $id;
        
        $secretarias_responsables = \yii\helpers\ArrayHelper::map(\backend\models\Secretarias::find()->all(), 'id', 'nombre');
        $secretarias_participantes = \yii\helpers\ArrayHelper::map(\backend\models\Secretarias::find()->all(), 'id', 'nombre');
        $proyectos_estrategicos = \yii\helpers\ArrayHelper::map(\backend\models\ProyectosEstrategicos::find()->all(), 'id', 'nombre');
        //$tareas = \yii\helpers\ArrayHelper::map(Seguimientos::find()->all(), 'id', 'tema');
              
        $minutas->fecha = date('Y-m-d');
        $minutas->tema = $minutas->seguimientos->tema;
        
        if ($minutas->load(Yii::$app->request->post())) {
            
            $minutas->datetime = date('Y-m-d H:I:s');
            $minutas->user_id = \Yii::$app->user->identity->id;
            $minutas->save();
            $minutas->folio = 'acdo-'.$minutas->id.'-'.date('Y');
            $minutas->save();
                
            if(isset($minutas->proyectos_estrategicos)){
                foreach ($minutas->proyectos_estrategicos as $proyectos){
                $m_proyectos = new \backend\models\MProyectos();
                $m_proyectos->minutas_id = $minutas->id;
                $m_proyectos->m_proyectos_estrategicos_id = $proyectos;
                $m_proyectos->save();
                }
            }
                                  
            return $this->redirect(['minutas/vista', 'id' => $minutas->id]);
        }

        return $this->renderAjax('minuta/nueva', [
            'minutas' => $minutas,
            'secretarias_responsables' => $secretarias_responsables,
            'proyectos_estrategicos' => $proyectos_estrategicos,
            'secretarias_participantes' => $secretarias_participantes,
        ]);
    }
    
    public function actionEditarStatus($id) {
        $model = $this->findModel($id);
        $status_actual = '';
        if ($model->status == 0) {
            $status_actual = "Vencido";
        } elseif ($model->status == 1) {
            $status_actual = "Completado";
        } elseif ($model->status == 2) {
            $status_actual = "En Proceso";
        } elseif ($model->status == 3) {
            $status_actual = "Sin Atencion";
        }

        $array = [0 => "Vencido", 1 => "Completado", 2 => "En Proceso", 3 => "Sin Atencion"];

        $status_disponibles = array_diff($array, array($status_actual));



        if ($model->load(Yii::$app->request->post()) ) {
            
             $model->status;
            
            $model->save();
            return $this->redirect(['minutas', 'id' => $model->id]);
        }

        return $this->renderAjax('editar/editar-status', [
                    'model' => $model,
                    'status_disponibles' => $status_disponibles
        ]);
    }
    
}
