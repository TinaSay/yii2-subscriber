<?php

namespace tina\subscriber\widgets;

use yii\base\Widget;
use tina\subscriber\models\Subscriber;

/**
 * Class SubscriberWidget
 *
 * @package tina\subscriber\widgets
 */
class SubscriberWidget extends Widget
{
    /**
     * @return string
     */
    public function run()
    {
        $model = new Subscriber();
        return $this->render('subscribe_form', [
            'model' => $model,
        ]);
    }
}
