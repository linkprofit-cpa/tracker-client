<?php

namespace linkprofit\Tracker\builder;

use linkprofit\Tracker\request\ReadUserBaseInfoQuery;
use linkprofit\Tracker\request\RouteInterface;

class ReadUserBaseInfoBuilder extends BaseBuilder
{
    /**
     * @return RouteInterface
     */
    public function createRoute()
    {
        return new ReadUserBaseInfoQuery();
    }
}
