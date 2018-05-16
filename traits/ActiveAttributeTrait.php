<?php

namespace tina\subscriber\traits;

use tina\subscriber\interfaces\ActiveAttributeInterface;
use yii\helpers\ArrayHelper;

/**
 * Trait ActiveAttributeTrait
 *
 * @package tina\subscriber\traits
 */
trait ActiveAttributeTrait
{
    /**
     * @return string
     */
    protected static function getActiveAttribute()
    {
        return 'active';
    }

    /**
     * @return array
     */
    public static function getActiveList()
    {
        return [
            ActiveAttributeInterface::ACTIVE_YES => 'Да',
            ActiveAttributeInterface::ACTIVE_NO => 'Нет',
        ];
    }

    /**
     * @return string
     */
    public function getActive()
    {
        return ArrayHelper::getValue(static::getActiveList(), $this->{static::getActiveAttribute()});
    }
}