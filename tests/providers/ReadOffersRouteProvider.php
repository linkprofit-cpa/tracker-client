<?php

namespace linkprofit\Tracker\tests\providers;

use linkprofit\Tracker\builder\ReadOffersBuilder;

class ReadOffersRouteProvider
{
    /**
     * @return \linkprofit\Tracker\request\ReadOffersRoute
     */
    public function get()
    {
        $builder = new ReadOffersBuilder();
        $builder->categoryId(1)->limit(1)->offset(20);

        return $builder->createRoute();
    }

    public function getEmpty()
    {
        $builder = new ReadOffersBuilder();

        return $builder->createRoute();
    }
}
