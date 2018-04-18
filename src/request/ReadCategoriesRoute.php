<?php

namespace linkprofit\Tracker\request;

/**
 * Class ReadCategoriesRoute
 *
 * @package linkprofit\Tracker\request
 */
class ReadCategoriesRoute extends BaseRoute
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
