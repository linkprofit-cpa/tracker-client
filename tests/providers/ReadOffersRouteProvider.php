<?php

namespace linkprofit\Tracker\tests\providers;

use linkprofit\Tracker\filter\OffersFilterBuilder;

class ReadOffersRouteProvider
{
    /**
     * @return \linkprofit\Tracker\request\ReadOffersRoute
     */
    public function get()
    {
        $builder = new OffersFilterBuilder();
        $builder->categoryId(1)->limit(1)->offset(20);

        return $builder->createRoute();
    }

    public function getEmpty()
    {
        $builder = new OffersFilterBuilder();

        return $builder->createRoute();
    }
}
