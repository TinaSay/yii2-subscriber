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
     * @return int
     */
    public function setLimit(int $limit);

    /**
     * @param int $offset
     *
     * @return int
     */
    public function setOffset(int $offset);

    /**
     * @param string $orderBy
     *
     * @return string
     */
    public function setOrderBy(string $orderBy);

    /**
     * @param array $params
     *
     * @return array
     */
    public function filter(array $params);
}