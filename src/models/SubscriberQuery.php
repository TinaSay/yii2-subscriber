<?php

namespace tina\subscriber\models;

/**
 * This is the ActiveQuery class for [[Subscriber]].
 *
 * @see Subscriber
 */
class SubscriberQuery extends \yii\db\ActiveQuery
{
    /**
     * @inheritdoc
     * @return Subscriber[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Subscriber|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @param int $blocked
     *
     * @return $this
     */
    public function blocked(int $blocked = Subscriber::BLOCKED_NO)
    {
        return $this->andWhere([
            Subscriber::tableName() . '.[[blocked]]' => $blocked,
        ]);
    }

    /**
     * @param int $active
     *
     * @return $this
     */
    public function active(int $active = Subscriber::ACTIVE_YES)
    {
        return $this->andWhere([
            Subscriber::tableName() . '.[[active]]' => $active,
        ]);
    }
}
