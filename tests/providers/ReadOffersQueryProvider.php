<?php

namespace linkprofit\Tracker\tests\providers;

use linkprofit\Tracker\builder\ReadOffersBuilder;

class ReadOffersQueryProvider
{
    /**
     * @return \linkprofit\Tracker\request\ReadOffersQuery
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
