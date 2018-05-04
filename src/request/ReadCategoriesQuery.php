<?php

namespace linkprofit\Tracker\request;

/**
 * Class ReadCategoriesQuery
 *
 * @package linkprofit\Tracker\request
 */
class ReadCategoriesQuery extends BaseRoute
{
    /**
     * @var string|null
     */
    protected $userUrl = '/cabinet/user/read/all/categories';

    /**
     * @var string|null
     */
    protected $adminUrl = '/administration/categories/read';

    /**
     * @var string
     */
    protected $method = 'PUT';
}
