<?php

namespace linkprofit\Tracker\filter;

use linkprofit\Tracker\request\OffersRequestContent;

/**
 * Class OffersFilterBuilder
 *
 * @package linkprofit\Tracker\filter
 */
class OffersFilterBuilder implements FilterBuilderInterface
{
    /**
     * @var array
     */
    public $params = [];

    /**
     * @return array
     */
    public function toArray()
    {
       return $this->params;
    }

    /**
     * @return OffersRequestContent
     */
    public function createRequestContent()
    {
        return new OffersRequestContent($this);
    }

    /**
     * @param $id
     * @return $this
     */
    public function categoryId($id)
    {
        $this->params['categoryId'] = $id;

        return $this;
    }

    /**
     * @return $this
     */
    public function isActive()
    {
        $this->params['active'] = 1;

        return $this;
    }

    /**
     * @return $this
     */
    public function notHidden()
    {
        $this->params['hidden'] = 0;

        return $this;
    }

    /**
     * @param $limit
     * @return $this
     */
    public function limit($limit)
    {
        $this->params['limit'] = $limit;

        return $this;
    }

    /**
     * @param $offset
     * @return $this
     */
    public function offset($offset)
    {
        $this->params['offset'] = $offset;

        return $this;
    }

    /**
     * @param $field
     * @return $this
     */
    public function orderByField($field)
    {
        $this->params['orderByField'] = $field;

        return $this;
    }
}
