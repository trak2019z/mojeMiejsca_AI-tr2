<?php
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\models\Uzytkownik */

$this->title = 'Tworzenie konta';
//$this->params['breadcrumbs'][] = $this->title;
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
    
    <div class="panel col-lg-6 col-lg-offset-4">
        <?= Html::tag('p','Jesteś zarejestrowany?',['class'=>'col-lg-5']) ?>
        <?= Html::a('Zaloguj się', Url::to(['site/login']),['class'=>'col-lg-3']) ?>
    </div>

</div>
