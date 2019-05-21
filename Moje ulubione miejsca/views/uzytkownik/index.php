<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UzytkownikSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Lista użytkowników';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="uzytkownik-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary'=>'',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            
            'username',
            'user_id',
//            'password',
            'email:email',
            'created_on',
            'last_login',
            'ban:boolean',

            ['class' => 'yii\grid\ActionColumn','template' => '{update}'],
        ],
    ]); ?>


</div>
