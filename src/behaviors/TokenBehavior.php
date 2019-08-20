<?php

namespace tina\subscriber\behaviors;

use Yii;
use yii\base\Event;
use yii\behaviors\AttributeBehavior;
use yii\db\ActiveRecord;

/**
 * Class TokenBehavior
 *
 * @package tina\subscriber\behaviors
 */
class TokenBehavior extends AttributeBehavior
{
    /**
     * @var string
     */
    public $attribute = 'token';

    /**
     * @var integer
     */
    public $stringLength = 128;

    public function init()
    {
        parent::init();

        if (empty($this->attributes)) {
            $this->attributes = [
                ActiveRecord::EVENT_BEFORE_INSERT => [$this->attribute],
            ];
        }
    }

    /**
     * @param Event $event
     *
     * @return mixed|string
     */
    protected function getValue($event)
    {
        return is_callable($this->value) ? call_user_func($this->value,
            $event) : Yii::$app->getSecurity()->generateRandomString($this->stringLength);
    }
}
