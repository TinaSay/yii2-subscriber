<?php

use krok\extend\widgets\YMap\YMapGeocodeWidget;
use krok\select2\Select2Widget;
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

<?= $form->field($model, 'groupIds')->widget(Select2Widget::class, [
    'items' => SubscriptionGroup::asDropDown(),
    'options' => [
        'multiple' => true,
    ],
]) ?>

<?= $form->field($model, 'coordinates')->widget(YMapGeocodeWidget::class, ['selector' => 'map']) ?>

<?= $form->field($model, 'city')->textInput(['maxlength' => true, 'class' => ['yandex-city', 'form-control']]) ?>

<?= $form->field($model, 'country')->textInput(['maxlength' => true, 'class' => ['yandex-country', 'form-control']]) ?>

<?= $form->field($model, 'blocked')->widget(Select2Widget::class, [
    'items' => Subscriber::getBlockedList(),
]) ?>

<?= $form->field($model, 'active')->widget(Select2Widget::class, [
    'items' => Subscriber::getActiveList(),
]) ?>
