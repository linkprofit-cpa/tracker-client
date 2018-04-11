<?php

namespace linkprofit\Tracker\tests\providers;

use linkprofit\Tracker\filter\OffersFilterBuilder;

class OffersRequestContentProvider
{
    /**
     * @return \linkprofit\Tracker\request\OffersRequestContent
     */
    public function get()
    {
        $builder = new OffersFilterBuilder();
        $builder->categoryId(1)->limit(1)->offset(20);

        return $builder->createRequestContent();
    }

    public function getEmpty()
    {
        $builder = new OffersFilterBuilder();

        return $builder->createRequestContent();
    }
}
