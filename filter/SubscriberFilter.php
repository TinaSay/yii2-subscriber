<?php

namespace tina\subscriber\filter;

use tina\subscriber\models\Subscriber;

/**
 * Class SubscriberFilter
 *
 * @package tina\subscriber\filter
 */
class SubscriberFilter implements SubscriberFilterInterface
{
    /**
     * @var int $limit
     */
    protected $limit;

    /**
     * @var int $offset
     */
    protected $offset;

    /**
     * @var string $orderBy
     */
    protected $orderBy;

    /**
     * @param int $limit
     *
     * @return $this|SubscriberFilterInterface
     */
    public function setLimit(int $limit)
    {
        $this->limit = $limit;

        return $this;
    }

    /**
     * @param int $offset
     *
     * @return $this|SubscriberFilterInterface
     */
    public function setOffset(int $offset)
    {
        $this->offset = $offset;

        return $this;
    }

    /**
     * @param array $orderBy
     *
     * @return $this|SubscriberFilterInterface
     */
    public function setOrderBy(array $orderBy)
    {
        $this->orderBy = $orderBy;

        return $this;
    }

    /**
     * @param array $condition
     *
     * @return array|Subscriber[]
     */
    public function filter(array $condition)
    {
        return Subscriber::find()
            ->where($condition)
            ->limit($this->limit)
            ->offset($this->offset)
            ->orderBy($this->orderBy)
            ->all();
    }
}
