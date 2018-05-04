<?php

namespace linkprofit\Tracker\request;

/**
 * Class ReadUsersQuery
 *
 * @package linkprofit\Tracker\request
 */
class ReadUsersQuery extends BaseRoute
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
