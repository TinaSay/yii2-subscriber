<?php

use tina\subscriber\assets\YandexMapAsset;
use tina\subscriber\models\Subscriber;
use yii\helpers\Html;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;

/** @var $this \yii\web\View */
/** @var $model Subscriber */

YandexMapAsset::register($this);

$this->registerJs(new JsExpression('jQuery("#country").addClass("country-yandex")'));
$this->registerJs(new JsExpression('jQuery("#city").addClass("city-yandex");'));
$this->registerJs(new JsExpression('jQuery("#coordinates").addClass("coordinates-yandex");'));
?>
<div class="contactform col-md-4">

    <?php $form = ActiveForm::begin(['action' => ['/subscriber/subscriber/save']]); ?>

    <?= $form->field($model, 'email') ?>

    <?= Html::activeHiddenInput($model, 'country', ['id' => 'country']) ?>
    <?= Html::activeHiddenInput($model, 'city', ['id' => 'city']) ?>
    <?= Html::activeHiddenInput($model, 'coordinates', ['id' => 'coordinates']) ?>

    <div class="form-group">
        <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
