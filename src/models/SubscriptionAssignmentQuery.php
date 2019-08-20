<?php

namespace tina\subscriber\models;

/**
 * This is the ActiveQuery class for [[SubscriptionAssignment]].
 *
 * @see SubscriptionAssignment
 */
class SubscriptionAssignmentQuery extends \yii\db\ActiveQuery
{
    /**
     * @inheritdoc
     * @return SubscriptionAssignment[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return SubscriptionAssignment|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
