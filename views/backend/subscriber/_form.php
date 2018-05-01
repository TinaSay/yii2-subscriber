<?php

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */

/* @var $model tina\subscriber\models\Subscriber */

use tina\subscriber\models\SubscriptionGroup;

?>

<?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
<?= $form->field($model, 'groupIDs')->dropDownList(SubscriptionGroup::asDropDown(), [
    'multiple' => true,
    'data-live-search' => 'true',
    'data-actions-box' => 'true',
]) ?>

<?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>
<?= $form->field($model, 'country')->textInput(['maxlength' => true]) ?>

