<?php

namespace linkprofit\Tracker\tests\providers;

use linkprofit\Tracker\filter\UsersFilterBuilder;

class ReadUsersRouteProvider
{
    /**
     * @return \linkprofit\Tracker\request\ReadUsersRoute
     */
    public function get()
    {
        $builder = new UsersFilterBuilder();
        $builder->statuses(['a', 'p'])->fields(['apiKey', 'refId'])->limit(5);

        return $builder->createRoute();
    }

    public function getEmpty()
    {
        $builder = new UsersFilterBuilder();

        return $builder->createRoute();
    }
}
