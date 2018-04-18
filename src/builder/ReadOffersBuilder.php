<?php

namespace linkprofit\Tracker\builder;

use linkprofit\Tracker\request\ReadOffersRoute;

/**
 * Class ReadOffersBuilder
 *
 * @package linkprofit\Tracker\filter
 */
class ReadOffersBuilder extends BaseBuilder
{
    /**
     * @return ReadOffersRoute
     */
    public function createRoute()
    {
        $route = new ReadOffersRoute();
        $route->setActiveFilters($this->toArray());

        return $route;
    }

    /**
     * @param $id
     *
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
     * @param $limit
     *
     * @return $this
     */
    public function limit($limit)
    {
        $this->params['limit'] = $limit;

        return $this;
    }

    /**
     * @param $offset
     *
     * @return $this
     */
    public function offset($offset)
    {
        $this->params['offset'] = $offset;

        return $this;
    }

    /**
     * @param $field
     *
     * @return $this
     */
    public function orderByField($field)
    {
        $this->params['orderByField'] = $field;

        return $this;
    }

    /**
     * @param $id
     *
     * @return $this
     */
    public function merchantManagerId($id)
    {
        $this->params['merchantManagerId'] = $id;

        return $this;
    }

    /**
     * Like поиск по полям, поля не указываются
     *
     * @param string $term
     *
     * @return $this
     */
    public function mainFilterItem($term)
    {
        $this->params['mainFilterItem'] = (string) $term;

        return $this;
    }
}
