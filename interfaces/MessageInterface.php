<?php

namespace tina\subscriber\interfaces;

use tina\subscriber\models\Subscriber;
use yii\base\Action;

/**
 * Interface MessageInterface
 *
 * @package tina\subscriber\interfaces
 */
interface MessageInterface
{
    /**
     * @param Subscriber $model
     * @param Action $action
     *
     * @return mixed
     */
    public function make(Subscriber $model, Action $action);
}
