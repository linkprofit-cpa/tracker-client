<?php

namespace linkprofit\Tracker\tests\providers;

use linkprofit\Tracker\request\ConnectionRoute;

class ConnectionRouteProvider
{
    public function getUser()
    {
        $connection = new ConnectionProvider();

        return new ConnectionRoute($connection->getUser());
    }
}
