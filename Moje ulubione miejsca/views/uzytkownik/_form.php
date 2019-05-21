<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;


$tz = 'Europe/Warsaw';
$timestamp = time();
$dt = new DateTime("now", new DateTimeZone($tz)); //first argument "must" be a string
$dt->setTimestamp($timestamp);
        
/* @var $this yii\web\View */
/* @var $model app\models\Uzytkownik */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="uzytkownik-form panel panel-default col-lg-6 col-lg-offset-3">
        <div class="panel-heading"><?= Html::encode($this->title) ?></div>
            <div class="panel-body">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'password2')->passwordInput(['maxlength' => true]) ?>            
    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'email2')->textInput(['maxlength' => true]) ?>
                
    <?= $form->field($model, 'created_on')->hiddenInput(['value' => $dt->format('Y-m-d H:i:s')])->label(false) ?>

    <?= $form->field($model, 'last_login')->textInput()->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'ban')->label(false)->checkbox(['checked'=>true,'class'=>'sr-only'],false) ?>

    <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
        'template' => '<div class="row"><div class="col-lg-3">{image}</div>'
        . '<div class="col-lg-6">{input}</div></div>']) ?>
    
    <?= Html::submitButton('Zarejestruj', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
</div>
