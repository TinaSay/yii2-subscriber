<?php

namespace tina\subscriber\filter;

use tina\subscriber\models\Subscriber;
use yii\base\BaseObject;

/**
 * Class SubscriberFilter
 *
 * @package tina\subscriber\filter
 */
class SubscriberFilter extends BaseObject implements SubscriberFilterInterface
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
     * @return $this|int
     */
    public function setLimit(int $limit)
    {
        $this->limit = $limit;
        return $this;
    }

    /**
     * @param int $offset
     *
     * @return $this|int
     */
    public function setOffset(int $offset)
    {
        $this->offset = $offset;
        return $this;
    }

    /**
     * @param string $orderBy
     *
     * @return $this|string
     */
    public function setOrderBy(string $orderBy)
    {
        $this->orderBy = $orderBy;
        return $this;
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