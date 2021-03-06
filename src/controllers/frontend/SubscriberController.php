<?php

namespace tina\subscriber\controllers\frontend;

use krok\system\components\frontend\Controller;
use tina\subscriber\actions\SaveAction;
use tina\subscriber\actions\UnsubscribeAction;

/**
 * Class SubscriberController
 *
 * @package tina\subscriber\controllers\frontend
 */
class SubscriberController extends Controller
{
    /**
     * @return array
     */
    public function actions()
    {
        return [
            'save' => [
                'class' => SaveAction::class,
            ],
            'unsubscribe' => [
                'class' => UnsubscribeAction::class,
            ],
        ];
    }
}
