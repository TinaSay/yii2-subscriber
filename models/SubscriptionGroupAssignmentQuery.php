<?php

namespace tina\subscriber\models;

/**
 * This is the ActiveQuery class for [[SubscriptionGroupAssignment]].
 *
 * @see SubscriptionGroupAssignment
 */
class SubscriptionGroupAssignmentQuery extends \yii\db\ActiveQuery
{
    /**
     * @inheritdoc
     * @return SubscriptionGroupAssignment[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return SubscriptionGroupAssignment|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
