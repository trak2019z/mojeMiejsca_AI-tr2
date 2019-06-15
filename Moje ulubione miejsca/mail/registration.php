<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this \yii\web\View view component instance */
/* @var $message \yii\mail\BaseMessage instance of newly created mail message */

?>
<p>Dzień dobry!</p>
<p>Właśnie zarejestrowałeś się na stronie <a href="http://91.188.125.149">Twoje ulubione miejsca</a><br />
Jeśli nie rejestrowałeś się na tej stronie, pomiń tą wiadomość. Jeśli tak, wciśnij link poniżej w celu aktywacji konta.</p>
<?= Html::a('Aktywacja konta', Url::to(['uzytkownik/activation', 'regcode' => $regcode], true),['class' => 'profile-link']) ?>