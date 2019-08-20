<?php

use krok\grid\BlockedColumn;
use krok\grid\DatePickerColumn;
use tina\subscriber\components\ActiveColumn;
use tina\subscriber\models\Subscriber;
use tina\subscriber\models\SubscriptionGroup;
use yii\grid\GridView;
use yii\helpers\Html;

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
                ['class' => 'yii\grid\ActionColumn'],
                'id',
                'email:email',
                'country',
                'city',
                [
                    'attribute' => 'ip',
                    'value' => function (Subscriber $model) {
                        return long2ip($model->ip);
                    },
                ],
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
                    'attribute' => 'groupIds',
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
            ],
        ]); ?>

    </div>
</div>
