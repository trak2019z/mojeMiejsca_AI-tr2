<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title ='Błąd!';
?>
<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode("Strona nie istnieje. Spróbuj ponownie później lub skontaktuj się z administratorem strony.")) ?>
    </div>

</div>
