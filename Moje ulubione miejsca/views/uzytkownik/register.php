<?php

/* @var $this yii\web\View */
/* @var $model app\models\Uzytkownik */

$this->title = 'Tworzenie konta';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rejestracja-uzytkownika">


    <?php if (Yii::$app->session->hasFlash('Registered')) { ?>

        <div class="alert alert-success col-lg-6 col-lg-offset-2">
            Właśnie się zarejestrowałeś. Sprawdź adres e-mail i aktywuj konto.
        </div>

    <?php 
    } else {
        echo $this->render('_form', [
            'model' => $model,
        ]);
    }
    ?>

</div>
