<?php

namespace backend\controllers;

use Yii;
use backend\models\Avances;
use backend\models\AvancesBuscar;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AvancesController implements the CRUD actions for Avances model.
 */
class AvancesController extends Controller
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
     * Lists all Avances models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AvancesBuscar();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Avances model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Avances model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Avances();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
    
    public function actionNuevoAvance($id)
    {
        $model = new Avances();
        $model->scenario = Avances::SCENARIO_NUEVO_ACANCE;
        $modelimg = new \backend\models\ImgAvances();
        
        $acuerdos = \yii\helpers\ArrayHelper::map(\backend\models\Acuerdos::find()->where(['minutas_id' => $id])->all(), 'id', 'acuerdo');
        

    
        $secretarias = array();
//         if(Yii::$app->user->can('create-branch')){
//             
//         }else{
//            throw new \yii\web\ForbiddenHttpException;
//        }
        
//         if(Yii::$app->user->can('admin-agregar-avance')){
//        $secretarias = \yii\helpers\ArrayHelper::map(\backend\models\Secretarias::find()->all(), 'id', 'nombre');           
//         }else{
//             
//             $responsables = \backend\models\Responsables::find()->where(['seguimientos_id' => $id])->all();
//            foreach ($responsables as $responsable) {
//                if ($responsable->secretarias_id == Yii::$app->user->identity->secretarias_id) {
//                $secretarias = \yii\helpers\ArrayHelper::map(\backend\models\Secretarias::find()->where(['id' => Yii::$app->user->identity->secretarias_id])->all(), 'id', 'nombre');         
//                }
//            }
//            $participantes = \backend\models\Participantes::find()->where(['seguimientos_id' => $id])->all();
//            foreach ($participantes as $participante) {
//                if ($participante->secretarias_id == Yii::$app->user->identity->secretarias_id) {
//                $secretarias = \yii\helpers\ArrayHelper::map(\backend\models\Secretarias::find()->where(['id' => Yii::$app->user->identity->secretarias_id])->all(), 'id', 'nombre');         
//                }
//            }
//
//            
//        }
        


        if ($model->load(Yii::$app->request->post()) or $modelimg->load(Yii::$app->request->post())) {
           $model->secretarias_id = Yii::$app->user->identity->secretarias_id;
           $model->fecha_captura = date('Y_m-d');
           $model->save();
            
   
                   if ($modelimg == true) {
                if (!is_dir(Yii::$app->basePath . '/web/avances' . '/' . $model->id)) {
                    mkdir(Yii::$app->basePath . '/web/avances' . '/' . $model->id);
                }

                $uploadPath = Yii::$app->basePath . '/web/avances' . '/' . $model->id . '/';
                $evidencias = \yii\web\UploadedFile::getInstances($modelimg, 'archivo');

                foreach ($evidencias as $file) {
                    $modelimgsave = new \backend\models\ImgAvances();
                    $original_name = $file->baseName;
                    $newFileName = \Yii::$app->security->generateRandomString() . '.' . $file->extension;
                    if ($file->saveAs($uploadPath . '/' . $newFileName)) {

                        $modelimgsave->archivo = $newFileName;
                        $modelimgsave->avances_id = $model->id;
                        $modelimgsave->fecha_captura = date('Y-m-d');
                        $modelimgsave->user_id = Yii::$app->user->identity->id;

                        $modelimgsave->save();
                    }
                }
            }
            
            //Notificacion
              //Genero Notificaciones Para Responsables
//                     $modelnotificaciones = new \app\models\Notificaciones();
//                     $modelnotificaciones->avances_id = $model->id;
//                     $modelnotificaciones->leido = '0';
//                     $modelnotificaciones->fecha_captura = date('Y-m-d');
//                     $modelnotificaciones->save();

            
            return $this->redirect(['/seguimientos/index']);
        }

        return $this->renderAjax('nuevo/nuevo-avance', [
            'model' => $model,
            'modelimg' => $modelimg,
            'acuerdos' => $acuerdos,
        ]);
    }

    /**
     * Updates an existing Avances model.
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
     * Deletes an existing Avances model.
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
     * Finds the Avances model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Avances the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Avances::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
