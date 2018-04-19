<?php

namespace linkprofit\Tracker\request;

/**
 * Class ReadUsersRoute
 *
 * @package linkprofit\Tracker\request
 */
class ReadUsersRoute extends BaseRoute
{
    /**
     * @var string|null
     */
    protected $userUrl;

    /**
     * @var string|null
     */
    protected $adminUrl = '/administration/read/users/list';

    /**
     * @var string
     */
    protected $method = 'PUT';

    /**
     * @var array
     */
    protected $filters = ['limit', 'offset', 'fields', 'statuses', 'dateInsertedFrom', 'dateInsertedTo', 'orderByField', 'orderByMethod'];
}
