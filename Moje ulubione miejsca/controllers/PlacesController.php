<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;

use app\models\Places;
use app\models\PlacesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PlacesController implements the CRUD actions for Places model.
 */
class PlacesController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index','create','update','delete'],
                'rules' => [
                    [
                        'actions' => ['index','create','update','delete'],
                        'allow' => true,
                        'roles' => ['@'],
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
     * Lists all Places models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PlacesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Places model.
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
     * Creates a new Places model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Places();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Places model.
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
     * Deletes an existing Places model.
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
    
    public function actionJson()
    {
        if(!Yii::$app->user->isGuest) {
                    
            $searchModel = new PlacesSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            $dataProvider->query->where(['ownerid'=>Yii::$app->user->id]);
            $dataProvider->query->orWhere(['public'=>'true']);
            
            $geojson = array(
                'type'      => 'FeatureCollection',
                'features'  => array()
             );

             foreach($dataProvider->models as $model) {
                 $feature = array(
    //                 'id' => $model['id'],
                     'type' => 'Feature', 
                     'geometry' => array(
                         'type' => 'Point',
                         'coordinates' => array($model['longitude'], $model['latitude'])
                     ),
                     'properties' => array(
                         'ownerid' => $model['ownerid'],
                         'grade' => $model['grade'],
                         'public' => $model['public'],
                         'text' => $model['text'],
                         'link' => $model['link'],
                         'name' => $model['name']

                         )
                     );
                 array_push($geojson['features'], $feature);
             }
        } else {
             $searchModel = new PlacesSearch();
             
             $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
             $dataProvider->query->where('public=true');
             
             $geojson = array(
                'type'      => 'FeatureCollection',
                'features'  => array()
             );

             foreach($dataProvider->models as $model) {
                 $feature = array(
    //                 'id' => $model['id'],
                     'type' => 'Feature', 
                     'geometry' => array(
                         'type' => 'Point',
                         'coordinates' => array($model['longitude'], $model['latitude'])
                     ),
                     'properties' => array(
                         'ownerid' => $model['ownerid'],
                         'grade' => $model['grade'],
                         'public' => $model['public'],
                         'text' => $model['text'],
                         'link' => $model['link'],
                         'name' => $model['name']

                         )
                     );
                 array_push($geojson['features'], $feature);
             }
        }
                    
             $this->renderJSON($geojson);
    }

    /**
     * Finds the Places model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Places the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Places::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
    protected function renderJSON($data) {
        header('Content-Type: application/json');
        echo 'eqfeed_callback('.json_encode($data,JSON_PRETTY_PRINT).');';
    }
}
