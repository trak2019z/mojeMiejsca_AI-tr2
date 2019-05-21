<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Uzytkownik */

$this->title = "Twój profil";
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="uzytkownik-view">


    <p>
        <?= Html::a('Aktualizuj moje dane', ['update', 'id' => $model->user_id], ['class' => 'btn btn-primary']) ?>
        
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'user_id',
            'username',
//            'password',
            'email:email',
            'created_on',
            'last_login',
//            'ban:boolean',
        ],
    ]) ?>

</div>
