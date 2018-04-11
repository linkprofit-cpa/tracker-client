<?php

namespace linkprofit\Tracker\tests\providers;


use linkprofit\Tracker\request\ConnectionRequestContent;

class ConnectionRequestContentProvider
{
    public function getUser()
    {
        $connection = new ConnectionProvider();
        $content = new ConnectionRequestContent($connection->getUser());

        return $content;
    }
}
