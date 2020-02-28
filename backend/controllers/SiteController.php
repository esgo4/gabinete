<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['get'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex() {
        //Reporte mensual

        if(Yii::$app->user->identity->nombres == null){
            $this->redirect('/index.php/usuarios/verificar?id='.Yii::$app->user->identity->id);
        }
        
        $fecha1 = date("Y-m-d", strtotime("- 14 days"));
        $fecha2 = date('Y-m-d');
        $day = array();
        for ($i = $fecha1; $i <= $fecha2; $i = date("Y-m-d", strtotime($i . "+ 1 days"))) {
            $day[] = $i;
            //aca puedes comparar $i a una fecha en la bd y guardar el resultado en un arreglo
        }
        $dias = json_encode($day);
        $seguimientodia = array();
        foreach ($day as $di) {

            $seguimientodia[] = $seguimientosxdia = \backend\models\Seguimiento::find()->where(['fecha_captura' => $di])->count();
        }

        $dia = json_encode($seguimientodia);

        //Termina reporte mensual
        //Barra Cumplimiento
        $totales = \backend\models\Seguimiento::find()->count();
        $vencido = \backend\models\Seguimiento::find()->where(['status' => '0'])->count();
        $completado = \backend\models\Seguimiento::find()->where(['status' => 1])->count();
        $enproceso = \backend\models\Seguimiento::find()->where(['status' => 2])->count();
        $sinatencion = \backend\models\Seguimiento::find()->where(['status' => 3])->count();

        //Calendario
        $calendario = \backend\models\Seguimiento::find()->all();


        foreach ($calendario as $eventos) {
            
        }




        //Termina Cumplimiento

        return $this->render('index', [
                    'dias' => $dias,
                    'dia' => $dia,
                    'totales' => $totales,
                    'vencido' => $vencido,
                    'completado' => $completado,
                    'enproceso' => $enproceso,
                    'sinatencion' => $sinatencion,
        ]);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
