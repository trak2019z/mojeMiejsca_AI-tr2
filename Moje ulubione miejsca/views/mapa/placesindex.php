<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PlacesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Places';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="places-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Places', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'ownerid',
            'latitude',
            'longitude',
            'text',
            //'link',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
