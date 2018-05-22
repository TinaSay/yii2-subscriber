<?php
/** @var $model Subscriber */

use tina\subscriber\assets\YandexMapAsset;
use tina\subscriber\models\Subscriber;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

YandexMapAsset::register($this);

$action = Url::to(['/subscriber/subscriber/save']);

/** @var $this \yii\web\View */
/* @var $list subscriber[] */

$this->registerJs(new \yii\web\JsExpression('jQuery("#country").addClass("country-yandex")'));
$this->registerJs(new \yii\web\JsExpression('jQuery("#city").addClass("city-yandex");'));
$this->registerJs(new \yii\web\JsExpression('jQuery("#coordinates").addClass("coordinates-yandex");'));
?>

<div class="contactform col-md-4">

    <?php $form = ActiveForm::begin(['action' => $action]); ?>

    <?= $form->field($model, 'email') ?>

    <?= Html::activeHiddenInput($model, 'country', ['id' => 'country']) ?>
    <?= Html::activeHiddenInput($model, 'city', ['id' => 'city']) ?>
    <?= Html::activeHiddenInput($model, 'coordinates', ['id' => 'coordinates']) ?>

    <div class="form-group">
        <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
