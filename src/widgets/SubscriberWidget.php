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
    public $template = 'subscribe_form.php';

    /**
     * @return string
     */
    public function run()
    {
        $model = new Subscriber();

        return $this->render($this->template, [
            'model' => $model,
        ]);
    }
}
