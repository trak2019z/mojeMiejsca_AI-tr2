<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PlacesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Lista ulubionych miejsc';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="places-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Nowe miejsce', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'summary'=>'',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'name',
//            'ownerid',
//            'latitude',
//            'longitude',
            'text',
            'grade',
            ['attribute'=>'public', 
                          'value'=>function($model) {
                                if($model->public==false) {
                                    return "Nie";
                                }
                                else {
                                    return "Tak";
                                }
                          }, 
                          'label'=>'Wpis publicznie dostępny'
            ],
            //'link',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
