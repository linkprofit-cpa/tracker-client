<?php

namespace linkprofit\Tracker\tests\providers;

use linkprofit\Tracker\builder\ReadOfferBuilder;

class ReadOfferQueryProvider
{
    /**
     * @return \linkprofit\Tracker\request\ReadOfferQuery
     */
    public function get()
    {
        $builder = new ReadOfferBuilder();
        $builder->offerId('1ee34g');

        return $builder->createRoute();
    }

    /**
     * @return \linkprofit\Tracker\request\ReadOfferQuery
     */
    public function getEmpty()
    {
        $builder = new ReadOfferBuilder();

        return $builder->createRoute();
    }
}
