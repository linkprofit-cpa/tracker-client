<?php

namespace linkprofit\Tracker\request;

use linkprofit\Tracker\builder\BuilderInterface;

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
     * @param BuilderInterface $builder
     * @param null $authToken
     */
    public function __construct(BuilderInterface $builder, $authToken = null)
    {
        $this->activeFilters = $builder->toArray();
        $this->authToken = $authToken;
    }
}
