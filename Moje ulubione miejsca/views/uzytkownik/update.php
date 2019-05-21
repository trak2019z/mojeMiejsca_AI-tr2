<?php

/* @var $this yii\web\View */
/* @var $model app\models\Uzytkownik */

$this->title = 'Edycja danych użytkownika';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="uzytkownik-update">


    <?= $this->render('_formupdate', [
        'model' => $model,
    ]) ?>

</div>
