<?php

namespace linkprofit\Tracker\request;

use linkprofit\Tracker\Connection;

/**
 * Class ConnectionRequestContent
 * @package linkprofit\Tracker\request
 */
class ConnectionRequestContent extends BaseRequestContent
{
    protected $config = [
        'userUrl' => '/authorization/user',
        'adminUrl' => '/authorization/employer',
        'method' => 'PUT',
        'required' => ['userName','userPassword'],
        'filters' => [],
    ];

    /**
     * ConnectionRequestContent constructor.
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        $this->filters = $connection->toArray();
        $this->accessLevel = $connection->accessLevel;
    }

    /**
     * @return int
     */
    public function getAccessLevel()
    {
        return $this->accessLevel;
    }

    /**
     * @return string
     */
    public function getAuthToken()
    {
        return $this->authToken;
    }
}