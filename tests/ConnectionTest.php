<?php

namespace linkprofit\AmoCRM\tests;

use linkprofit\Tracker\AccessLevel;
use linkprofit\Tracker\Connection;
use PHPUnit\Framework\TestCase;

class ConnectionTest extends TestCase
{
    /**
     * @var Connection
     */
    public $connection;

    public function testDefaultAccessLevel()
    {
        $this->assertEquals($this->connection->accessLevel, AccessLevel::USER);
    }

    public function testToArray()
    {
        $this->connection = new Connection('user', 'password', 'api_url');
        $this->assertEquals(['userName' => 'user', 'userPassword' => 'password'], $this->connection->toArray());
    }

    public function setUp()
    {
        $this->connection = new Connection();
    }
}