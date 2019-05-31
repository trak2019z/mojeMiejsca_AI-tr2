<!--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDqVFNzzRZxwJ9EALZa04PEH2hAnATXkyg&callback=initMap" async defer></script>-->
<?php
use Yii\web\View;
$this->registerCssFile('@web/css/mapa.css');
$this->registerJsFile('@web/js/screen-height-check.js');
$this->registerJsFile('@web/js/panelFunctions.js',['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('https://maps.googleapis.com/maps/api/js?key=AIzaSyDqVFNzzRZxwJ9EALZa04PEH2hAnATXkyg&callback=initMap',['position' => View::POS_HEAD, 'async'=>false, 'defer'=>true]);

$this->registerJsFile('@web/js/mapa.js');
/* @var $this yii\web\View */

?>
<div class="site-index">

    <div id='map'>
        <div class='mapPanel'>Test</div>
        
    </div>
    
    
</div>
