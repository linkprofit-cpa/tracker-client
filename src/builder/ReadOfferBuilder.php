<?php

namespace linkprofit\Tracker\builder;

use linkprofit\Tracker\request\ReadOfferQuery;

/**
 * Class ReadOfferBuilder
 *
 * @package linkprofit\Tracker\builder
 */
class ReadOfferBuilder extends BaseBuilder
{
    /**
     * @return ReadOfferQuery
     */
    public function createRoute()
    {
        $route = new ReadOfferQuery();
        $route->setActiveFilters($this->toArray());

        return $route;
    }

    /**
     * @param $id
     *
     * @return $this
     */
    public function offerId($id)
    {
        $this->params['offerId'] = $id;

        return $this;
    }
}
