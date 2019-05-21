<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Uzytkownik */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="uzytkownik-form panel panel-default col-lg-6 col-lg-offset-3">
    <div class="panel-heading"><?= Html::encode('Użytkownik: '.$model->username) ?></div>
        <div class="panel-body">
            <?php $form = ActiveForm::begin(); ?>

                <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
                <?= Html::submitButton('Zaktualizuj', ['class' => 'btn btn-success']) ?>

            <?php ActiveForm::end(); ?>
        </div>

        
    </div>
</div>
