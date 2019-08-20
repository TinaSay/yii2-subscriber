<?php

use krok\select2\Select2Widget;
use tina\subscriber\models\SubscriptionGroup;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model tina\subscriber\models\SubscriptionGroup */
?>

<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'hidden')->widget(Select2Widget::class, [
    'items' => SubscriptionGroup::getHiddenList(),
]) ?>
