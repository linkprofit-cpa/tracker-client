<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11.04.18
 * Time: 14:23
 */

namespace linkprofit\Tracker\tests\providers;

use linkprofit\Tracker\filter\OffersFilterBuilder;
use linkprofit\Tracker\request\OffersRequestContent;

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
