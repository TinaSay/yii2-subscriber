<?php

namespace tina\subscriber\behaviors;

use yii\behaviors\AttributeBehavior;
use yii\db\ActiveRecord;
use Closure;
use Yii;

/**
 * Class TokenBehavior
 *
 * @package tina\subscriber\behaviors
 */
class TokenBehavior extends AttributeBehavior
{
    /** @var string */
    public $attribute = 'token';

    /** @var string */
    public $stringLength;

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
     * @param \yii\base\Event $event
     *
     * @return mixed|string
     */
    protected function getValue($event)
    {
        return $this->value instanceof Closure ? call_user_func($this->value,
            $event) : Yii::$app->getSecurity()->generateRandomString($this->stringLength);
    }
}
