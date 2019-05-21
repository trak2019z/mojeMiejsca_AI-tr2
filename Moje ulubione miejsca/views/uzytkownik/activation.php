<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this \yii\web\View view component instance */
/* @var $message \yii\mail\BaseMessage instance of newly created mail message */
echo Html::tag('p','Konto użytkownika '.$username.' zostało aktywowane.');
echo Html::tag('p','Od tej pory możesz logowac się na stronie.');
echo Html::a('Aktywacja konta', Url::to(['site/login'], true),['class' => 'profile-link']); 


