<?php

namespace app\controllers;

use Yii;

use app\models\Uzytkownik;
use app\models\UzytkownikSearch;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * UzytkownikController implements the CRUD actions for Uzytkownik model.
 */
class UzytkownikController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['register','index','update','view','activation'],
                'rules' => [
                    [
                        'actions' => ['index','update','view'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['register','activation'],
                        'allow' => true,
                        'roles' => ['?'],
                    ]
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],  
        ];
    }

    /**
     * Lists all Uzytkownik models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UzytkownikSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Uzytkownik model.
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
     * Creates a new Uzytkownik model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionRegister()
    {
        
        
        $model = new Uzytkownik();
        $model->scenario= Uzytkownik::SCENARIO_REGISTRATION;

        if ($model->load(Yii::$app->request->post())) {
            $model->password=md5($model->password);
            $model->password2=$model->password;
            $model->regcode= md5($model->user_id.$model->created_on);
            
            if($model->save()) {
                
                Yii::$app->mailer->compose('registration',['regcode'=>$model->regcode])
                    ->setTo($model->email)
                    ->setFrom("student.161587@gmail.com")
                    ->setSubject("Rejestracja")
                    ->send();
                Yii::$app->session->setFlash('Registered');
                return $this->refresh();
                 
            }
        }

        return $this->render('register', [
            'model' => $model,            
        ]);
    }

    /**
     * Updates an existing Uzytkownik model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModelonUpdate($id);
        $password=$model->password;
        if ($model->load(Yii::$app->request->post())) {
            if($password!=$model->password) {
                $model->password=md5($model->password);
            }
            if($model->save()) {
                return $this->redirect(['view', 'id' => $model->user_id]);
            }
        }
           

        return $this->render('update', [
            'model' => $model,
        ]);
    }
    
    public function actionActivation($regcode)
    {
        $model=$this->findUserWithActivationCode($regcode);
        $username=$model->username;
        return $this->render('activation',['username'=>$username]);
        
        
    }

    /**
     * Deletes an existing Uzytkownik model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
//    public function actionDelete($id)
//    {
//        $this->findModel($id)->delete();
//
//        return $this->redirect(['index']);
//    }

    /**
     * Finds the Uzytkownik model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Uzytkownik the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Uzytkownik::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Znalezienie użytkownika nie powiodło się.');
    }
    
    protected function findModelonUpdate($id)
    {
        if (($model = Uzytkownik::findOne($id)) !== null) {
            $model->scenario= Uzytkownik::SCENARIO_UPDATE;
            return $model;
        }

        throw new NotFoundHttpException('Znalezienie użytkownika nie powiodło się.');
    }
    
    public function findUserWithActivationCode($code) {
        $model= Uzytkownik::find()->where(['regcode'=>$code])->one();
        if(!is_null($model) && $model->ban==true) {
            $model->ban=false;
            $model->save(false);
            return $model;
        }
        throw new NotFoundHttpException('Wystąpił błąd aktywacji konta. '
                . 'Konto nie istnieje lub zostało już aktywowane');
    }
}
