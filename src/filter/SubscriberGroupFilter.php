<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 12.09.19
 * Time: 9:48
 */

namespace tina\subscriber\filter;

use tina\subscriber\models\Subscriber;
use tina\subscriber\models\SubscriptionGroup;
use tina\subscriber\models\SubscriptionGroupQuery;
use yii\helpers\ArrayHelper;

/**
 * Class SubscriberGroupFilter
 *
 * @package tina\subscriber\filter
 */
class SubscriberGroupFilter implements SubscriberGroupFilterInterface
{
    /**
     * @return array
     */
    public function list(): array
    {
        return ArrayHelper::map(SubscriptionGroup::find()->hidden()->language()->asArray()->all(), 'id', 'title');
    }

    /**
     * @param int $id
     *
     * @return array
     */
    public function one(int $id): array
    {
        return Subscriber::find()->select([
            Subscriber::tableName() . '.[[email]]',
        ])->innerJoinWith([
            'groupsRelation' => function (SubscriptionGroupQuery $query) use ($id) {
                $query->onCondition([
                    SubscriptionGroup::tableName() . '.[[id]]' => $id,
                ])->hidden()->language();
            },
        ])->blocked()->active()->asArray()->column();
    }
}
