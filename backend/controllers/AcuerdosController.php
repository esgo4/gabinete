<?php

namespace backend\controllers;

use Yii;
use backend\models\Acuerdos;
use backend\models\AcuerdosBuscar;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AcuerdosController implements the CRUD actions for Acuerdos model.
 */
class AcuerdosController extends Controller
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
     * Lists all Acuerdos models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AcuerdosBuscar();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Acuerdos model.
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
     * Creates a new Acuerdos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Acuerdos();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
    
    public function actionNuevoAcuerdo($id)
    {
        $model = new Acuerdos();
        $model->minutas_id = $id;
        
        $secretariasdata = array();
        
        $responsables = \backend\models\Responsables::find()->where(['seguimientos_id' => $model->minutas->seguimientos_id])->all();
        foreach ($responsables as $responsables){
           $secretariasdata[] = $responsables->secretarias_id;
        }
        $participantes = \backend\models\Participantes::find()->where(['seguimientos_id' => $model->minutas->seguimientos_id])->all();
        foreach ($participantes as $participante){
           $secretariasdata[] = $participante->secretarias_id;
        }
        
        
        $secretarias = \yii\helpers\ArrayHelper::map(\backend\models\Secretarias::find()->where(['id' => $secretariasdata])->all(), 'id', 'nombre');

                
                

        if ($model->load(Yii::$app->request->post()) ) {
            
            $model->fecha_inicio = date('Y-m-d');
            $model->user_id = \Yii::$app->user->identity->id;
            $model->save();
            return $this->redirect(['minutas/vista', 'id' => $model->minutas_id]);
        }

        return $this->renderAjax('nuevo/nuevo-acuerdo', [
            'model' => $model,
            'secretarias' => $secretarias,
        ]);
      }

    /**
     * Updates an existing Acuerdos model.
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
     * Deletes an existing Acuerdos model.
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
     * Finds the Acuerdos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Acuerdos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Acuerdos::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
