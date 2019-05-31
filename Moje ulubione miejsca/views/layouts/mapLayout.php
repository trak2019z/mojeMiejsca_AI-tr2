<?php

/* @var $this \yii\web\View */
/* @var $content string */
use Yii;
use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
$this->title="Twoje ulubione miejsca" ;
AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap mapBottomPadding">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    if(!Yii::$app->user->isGuest) {
        echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Mapa', 'url' => ['/mapa/index']],
            ['label' => 'Twoje miejsca', 'url' => ['/places/index']],
            ['label' => 'Twój profil', 'url' => ['/uzytkownik/view', 'id'=>Yii::$app->user->identity->user_id]],
            ['label' => 'Kontakt', 'url' => ['/site/contact']],
            '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Wyloguj (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
            . '</li>'
            
            ],
        ]);
    } else {
        echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Kontakt', 'url' => ['/site/contact']],
            ['label' => 'Rejestracja & Logowanie', 'url' => ['/site/login']]            
        ],
        ]);
    }
    
    NavBar::end();
    ?>

    <div class="mapPanel">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Zbigniew Wnęk, <?= date('Y') ?></p>   
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
