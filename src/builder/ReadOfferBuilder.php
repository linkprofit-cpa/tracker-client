<?php

namespace linkprofit\Tracker\builder;

use linkprofit\Tracker\request\ReadOfferRoute;

/**
 * Class ReadOfferBuilder
 *
 * @package linkprofit\Tracker\builder
 */
class ReadOfferBuilder extends BaseBuilder
{
    /**
     * @return ReadOfferRoute
     */
    public function createRoute()
    {
        $route = new ReadOfferRoute();
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
