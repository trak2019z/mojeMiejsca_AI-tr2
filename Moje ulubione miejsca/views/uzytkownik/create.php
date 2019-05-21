<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Uzytkownik */

$this->title = 'Create Uzytkownik';
$this->params['breadcrumbs'][] = ['label' => 'Uzytkowniks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="uzytkownik-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
