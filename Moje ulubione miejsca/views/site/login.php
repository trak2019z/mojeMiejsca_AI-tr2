<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'Logowanie';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <div class="panel panel-default col-lg-6 col-lg-offset-3">
        <div class="panel-heading">Logowanie</div>
            <div class="panel-body">

                <?php $form = ActiveForm::begin([
                    'id' => 'login-form',
                    'layout' => 'horizontal',

                    'fieldConfig' => [
                        'template' => "{label}\n<div class=\"col-lg-4\">{input}</div>\n<div class=\"col-lg-5\">{error}</div>",
                        'labelOptions' => ['class' => 'col-lg-3 control-label'],
                    ],
                    ]); 
                ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label('Użytkownik') ?>
                <?= $form->field($model, 'password')->passwordInput()->label('Hasło') ?>

                <div class="form-group">
                <div class="col-lg-offset-5 col-lg-11">
                    <?= Html::submitButton('Zaloguj', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>
                </div>

            <?php ActiveForm::end(); ?>
                
            
            </div>
    </div>
    
    <div class="panel col-lg-6 col-lg-offset-3">
        <?= Html::tag('p','Nie jesteś zarejestrowanym użytkownikiem?',['class'=>'col-lg-7']) ?>
        <?= Html::a('Zarejestruj się', Url::to(['uzytkownik/register']),['class'=>'col-lg-3']) ?>
    </div>
    
    
</div>
