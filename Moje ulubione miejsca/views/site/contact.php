<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Kontakt';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact col-lg-offset-3 col-lg-8">

    <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>

        <div class="alert alert-success col-lg-6">
            Dziękuję za wysłanie wiadomości. Postaram się odpowiedzieć najszybciej
            jak to będzie możliwe.
        </div>

    <?php else: ?>

        <p>
            Jeśli masz jakieś pytania, uzupełnij formularz i wyślij. Dziękuję.
        </p>

        <div class="row">
            <div class="col-lg-8">

                <?php $form = ActiveForm::begin(['id' => 'contact-form']);

                    if(Yii::$app->user->isGuest) {
                    
                        echo $form->field($model, 'name')->textInput(['autofocus' => true])->label('Imię');
                        echo $form->field($model, 'email')->label('E-mail');
                        echo $form->field($model, 'subject')->label('Tytuł');
                        echo $form->field($model, 'body')->textarea(['rows' => 6])->label('Treść');
                        echo $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                            'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                        ]);
                    } else {
                        echo $form->field($model,'name')->hiddenInput(['value'=> Yii::$app->user->identity->username])->label(false);
                        echo $form->field($model,'email')->hiddenInput(['value'=> Yii::$app->user->identity->email])->label(false);
                        echo $form->field($model, 'subject')->label('Tytuł');
                        echo $form->field($model, 'body')->textarea(['rows' => 6])->label('Treść');
                    }
                    ?>

                    <div class="form-group">
                        <?= Html::submitButton('Wyślij', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                    </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>

    <?php endif; ?>
</div>
