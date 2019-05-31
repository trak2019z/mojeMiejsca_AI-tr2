<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Places */

//$this->title = $model->id;
//$this->params['breadcrumbs'][] = ['label' => 'Places', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="places-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Zaktualizuj', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Usuń', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'id',
//            'ownerid',
            'name',
            'text',
            'grade',
            'link',
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
//            'latitude',
//            'longitude',
            
            
            
        ],
    ]) ?>

</div>
