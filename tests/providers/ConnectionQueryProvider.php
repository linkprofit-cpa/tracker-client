<?php

namespace linkprofit\Tracker\tests\providers;

use linkprofit\Tracker\request\ConnectionQuery;

class ConnectionQueryProvider
{
    public function getUser()
    {
        $connection = new ConnectionProvider();

        return new ConnectionQuery($connection->getUser());
    }
}
