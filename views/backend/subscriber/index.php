<?php

use yii\helpers\Html;
use yii\grid\GridView;
use krok\extend\grid\DatePickerColumn;
use krok\extend\grid\BlockedColumn;
use tina\subscriber\grid\ActiveColumn;
use tina\subscriber\models\SubscriptionGroup;
use tina\subscriber\models\Subscriber;

/* @var $this yii\web\View */
/* @var $searchModel tina\subscriber\models\SubscriberSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('system', 'Subscriber');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card">

    <div class="card-header">
        <h4 class="card-title"><?= Html::encode($this->title) ?></h4>
    </div>

    <div class="card-header">
        <p>
            <?= Html::a(Yii::t('system', 'Create'), ['create'], [
                'class' => 'btn btn-success',
            ]) ?>
        </p>
    </div>

    <div class="card-content">

        <?= GridView::widget([
            'tableOptions' => ['class' => 'table'],
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'id',
                'email:email',
                'country',
                'city',
                'coordinates',
                'ip',
                'link',
                [
                    'class' => BlockedColumn::class,
                    'attribute' => 'blocked',

                ],
                [
                    'class' => ActiveColumn::class,
                    'attribute' => 'active',
                ],
                [
                    'attribute' => 'groupIDs',
                    'filter' => SubscriptionGroup::asDropDown(),
                    'value' => function (Subscriber $model) {
                        return $model->getGroupsString();
                    },
                ],
                [
                    'class' => DatePickerColumn::class,
                    'attribute' => 'createdAt',
                ],
                [
                    'class' => DatePickerColumn::class,
                    'attribute' => 'updatedAt',
                ],
                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>

    </div>
</div>
