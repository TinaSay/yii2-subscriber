<?php

namespace tina\subscriber\interfaces;

use tina\subscriber\models\Subscriber;
use yii\base\Action;
use yii\mail\MessageInterface as BaseMessageInterface;

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
     * @return BaseMessageInterface
     */
    public function make(Subscriber $model, Action $action): BaseMessageInterface;
}
