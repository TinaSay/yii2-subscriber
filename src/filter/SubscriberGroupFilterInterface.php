<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 12.09.19
 * Time: 9:46
 */

namespace tina\subscriber\filter;

/**
 * Interface SubscriberGroupFilterInterface
 *
 * @package tina\subscriber\filter
 */
interface SubscriberGroupFilterInterface
{
    /**
     * @return array
     */
    public function list(): array;

    /**
     * @param int $id
     *
     * @return array
     */
    public function one(int $id): array;
}
