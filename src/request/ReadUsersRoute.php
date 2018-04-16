<?php

namespace linkprofit\Tracker\request;

use linkprofit\Tracker\filter\FilterBuilderInterface;

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
    protected $filters = ['limit', 'fields', 'statuses'];

    /**
     * OffersRequestContent constructor.
     * @param FilterBuilderInterface $filterBuilder
     * @param null $authToken
     */
    public function __construct(FilterBuilderInterface $filterBuilder, $authToken = null)
    {
        $this->activeFilters = $filterBuilder->toArray();
        $this->authToken = $authToken;
    }
}
