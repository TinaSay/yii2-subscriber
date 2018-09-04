<?php

namespace tina\subscriber\components;

/**
 * Interface ActiveAttributeInterface
 *
 * @package tina\subscriber\components
 */
interface ActiveAttributeInterface
{
    const ACTIVE_YES = 1;
    const ACTIVE_NO = 0;

    /**
     * @return array
     */
    public static function getActiveList();

    /**
     * @return string
     */
    public function getActive();
}
