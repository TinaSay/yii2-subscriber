<?php

use tina\subscriber\assets\YandexMapAsset;
use tina\subscriber\models\Subscriber;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

YandexMapAsset::register($this);

$action = Url::to(['save-form']);

/** @var $this \yii\web\View */
/* @var $list subscriber[] */
?>

<div class="contactform col-md-4">

    <?php $form = ActiveForm::begin(['action' => $action]); ?>

    <?= $form->field($model, 'email') ?>

    <?= Html::activeHiddenInput($model, 'country', ['id' => 'country']) ?>
    <?= Html::activeHiddenInput($model, 'city', ['id' => 'city']) ?>

    <div class="form-group">
        <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
