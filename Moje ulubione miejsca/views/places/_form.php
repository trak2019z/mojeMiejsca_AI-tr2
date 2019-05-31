<?php
//use Yii;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use Yii\web\View;

$this->registerCssFile('@web/css/mapa.css');
$this->registerJsFIle('@web/js/screen-height-check-forCreateMap.js');
$this->registerJsFile('https://maps.googleapis.com/maps/api/js?key=##&callback=initMap',['position' => View::POS_HEAD, 'async'=>false, 'defer'=>true]);
$this->registerJsFile('@web/js/createMap.js');
/* @var $this yii\web\View */
/* @var $model app\models\Places */
/* @var $form yii\widgets\ActiveForm */
?>
<div id='createMap' class="createMap pull-left col-lg-5"></div>
<div class="places-form pull-right col-lg-7">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ownerid')->hiddenInput(['value'=>Yii::$app->user->identity->user_id])->label(false) ?>

    

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'text')->textarea(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'grade')->dropdownlist([1=>1,2=>2,3=>3,4=>4,5=>5,6=>6]) ?>
    
    
    
    <?= $form->field($model, 'latitude')->textInput(['readonly'=>true]) ?>

    <?= $form->field($model, 'longitude')->textInput(['readonly'=>true]) ?>

    <?= $form->field($model, 'link')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'public')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Zapisz nowe miejsce', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
