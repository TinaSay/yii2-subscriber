<?php

namespace tina\subscriber\filter;

use tina\subscriber\models\Subscriber;
use yii\helpers\ArrayHelper;

/**
 * Class SubscriberFilter
 *
 * @package tina\subscriber\filter
 */
class SubscriberFilter implements SubscriberFilterInterface
{
    /**
     * @return array
     */
    public function list(): array
    {
        return ArrayHelper::map(Subscriber::find()->blocked()->active()->asArray()->all(), 'email', 'email');
    }
}
