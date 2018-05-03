<?php

namespace tina\subscriber\models;

use Yii;

/**
 * This is the ActiveQuery class for [[SubscriptionGroup]].
 *
 * @see SubscriptionGroup
 */
class SubscriptionGroupQuery extends \yii\db\ActiveQuery
{
    /**
     * @inheritdoc
     * @return SubscriptionGroup[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return SubscriptionGroup|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @param null|string $language
     *
     * @return $this
     */
    public function language($language = null)
    {
        if ($language === null) {
            $language = Yii::$app->language;
        }

        $this->andWhere(['[[language]]' => $language]);

        return $this->andWhere([Subscriber::tableName() . '.[[language]]' => $language]);
    }
}
