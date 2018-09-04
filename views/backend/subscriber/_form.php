<?php

use krok\extend\widgets\YMap\YMapGeocodeWidget;
use tina\subscriber\assets\YandexMapAsset;
use tina\subscriber\models\Subscriber;
use tina\subscriber\models\SubscriptionGroup;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model tina\subscriber\models\Subscriber */

YandexMapAsset::register($this);

$this->registerJs(new JsExpression('ymaps.ready(function() { setTimeout(function() { mapYMap.events.add(\'click\', function (e) {
var coords = e.get(\'coords\');

ymaps.geocode(coords).then(function (result) {
        var metaDataProperty = result.geoObjects.get(0).properties.get(\'metaDataProperty\');
        var country = metaDataProperty.GeocoderMetaData.AddressDetails.Country.CountryName;
        var city = metaDataProperty.GeocoderMetaData.AddressDetails.Country.AddressLine;
       
        $(\'.yandex-country\').val(country);
        $(\'.yandex-city\').val(city);
        });
}, 50);}) })'));

?>

<?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'groupIDs')->dropDownList(SubscriptionGroup::asDropDown(), [
    'multiple' => true,
    'data-live-search' => 'true',
    'data-actions-box' => 'true',
]) ?>

<?= $form->field($model, 'coordinates')->widget(YMapGeocodeWidget::className(), ['selector' => 'map']) ?>

<?= $form->field($model, 'city')->textInput(['maxlength' => true, 'class' => ['yandex-city', 'form-control']]) ?>

<?= $form->field($model, 'country')->textInput(['maxlength' => true, 'class' => ['yandex-country', 'form-control']]) ?>

<?= $form->field($model, 'blocked')->dropDownList(Subscriber::getBlockedList()) ?>

<?= $form->field($model, 'active')->dropDownList(Subscriber::getActiveList()) ?>
