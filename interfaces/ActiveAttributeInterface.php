<?php

namespace tina\subscriber\interfaces;

/**
 * Interface ActiveAttributeInterface
 *
 * @package tina\subscriber\interfaces
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