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
     * @param int $limit
     *
     * @return SubscriberFilterInterface
     */
    public function setLimit(int $limit);

    /**
     * @param int $offset
     *
     * @return SubscriberFilterInterface
     */
    public function setOffset(int $offset);

    /**
     * @param array $orderBy
     *
     * @return SubscriberFilterInterface
     */
    public function setOrderBy(array $orderBy);

    /**
     * @param array $params
     *
     * @return array
     */
    public function filter(array $params);
}