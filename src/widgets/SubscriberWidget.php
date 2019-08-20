<?php

namespace tina\subscriber\widgets;

use tina\subscriber\models\Subscriber;
use yii\base\Widget;

/**
 * Class SubscriberWidget
 *
 * @package tina\subscriber\widgets
 */
class SubscriberWidget extends Widget
{
    /**
     * @var string
     */
    public $view = 'subscribe_form';

    /**
     * @return string
     */
    public function run()
    {
        $model = new Subscriber();

        return $this->render($this->view, [
            'model' => $model,
        ]);
    }
}
