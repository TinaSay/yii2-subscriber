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
     * @param $limit
     *
     * @return mixed
     */
    public function setLimit($limit);

    /**
     * @param $offset
     *
     * @return mixed
     */
    public function setOffset($offset);

    /**
     * @param $orderBy
     *
     * @return mixed
     */
    public function setOrder($orderBy);

    /**
     * @param array $params
     *
     * @return mixed
     */
    public function filter(array $params);
}