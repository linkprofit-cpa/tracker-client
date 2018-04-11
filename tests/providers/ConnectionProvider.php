<?php

namespace linkprofit\Tracker\tests\providers;

use linkprofit\Tracker\AccessLevel;
use linkprofit\Tracker\Connection;

class ConnectionProvider
{
    public function getUser()
    {
        $connection = new Connection();

        $connection->userName = "user";
        $connection->userPassword = "password";
        $connection->apiUrl = "http://api.ru";

        return $connection;
    }

    public function getAdmin()
    {
        $connection = new Connection();

        $connection->userName = "user";
        $connection->userPassword = "password";
        $connection->apiUrl = "http://api.ru";
        $connection->accessLevel = AccessLevel::ADMIN;

        return $connection;
    }

    public function getEmpty()
    {
        return new Connection();
    }
}
