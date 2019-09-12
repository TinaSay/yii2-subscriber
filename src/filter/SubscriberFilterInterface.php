<?php

namespace tina\subscriber\filter;

/**
 * Interface SubscriberFilterInterface
 *
 * @package tina\subscriber\filter
 */
interface SubscriberFilterInterface
{
    /**
     * @return array
     */
    public function list(): array;
}
