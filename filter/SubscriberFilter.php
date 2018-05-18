<?php

namespace tina\subscriber\filter;

use tina\subscriber\models\Subscriber;

/**
 * Class SubscriberFilter
 *
 * @package tina\subscriber\filter
 */
class SubscriberFilter extends Subscriber implements SubscriberFilterInterface
{
    /**
     * @var int $limit
     */
    public $limit;

    /**
     * @var int $offset
     */
    public $offset;

    /**
     * @var string $orderBy
     */
    public $orderBy;

    /**
     * @param $limit
     *
     * @return mixed|void
     */
    public function setLimit($limit)
    {
        $this->limit = $limit;
    }

    /**
     * @param $offset
     *
     * @return mixed|void
     */
    public function setOffset($offset)
    {
        $this->offset = $offset;
    }

    /**
     * @param $orderBy
     *
     * @return mixed|void
     */
    public function setOrder($orderBy)
    {
        $this->orderBy = $orderBy;
    }

    /**
     * @param array $params
     *
     * @return array|Subscriber[]
     */
    public function filter(array $params)
    {
        return Subscriber::find()
            ->where($params)
            ->limit($this->limit)
            ->offset($this->offset)
            ->orderBy($this->orderBy)
            ->all();
    }
}