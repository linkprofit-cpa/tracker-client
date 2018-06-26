<?php

namespace linkprofit\Tracker\request;

use linkprofit\Tracker\Connection;
use linkprofit\Tracker\exception\ConnectionExceptionHandler;

/**
 * Class ConnectionQuery
 *
 * @package linkprofit\Tracker\request
 */
class ConnectionQuery extends BaseRoute
{
    /**
     * @var string|null
     */
    protected $userUrl = '/authorization/user';

    /**
     * @var string|null
     */
    protected $adminUrl = '/authorization/employer';

    /**
     * @var string
     */
    protected $method = 'PUT';

    /**
     * @var array
     */
    protected $required = ['userName', 'userPassword'];

    /**
     * ConnectionRequestContent constructor.
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        $this->activeFilters = $connection->toArray();
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

    /**
     * @return ConnectionExceptionHandler
     */
    public function getExceptionHandler()
    {
        return new ConnectionExceptionHandler();
    }
}
