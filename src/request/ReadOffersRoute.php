<?php

namespace linkprofit\Tracker\request;

use linkprofit\Tracker\builder\BuilderInterface;

/**
 * Class OffersRequestContent
 *
 * @package linkprofit\Tracker\request
 */
class ReadOffersRoute extends BaseRoute
{
    /**
     * @var string|null
     */
    protected $userUrl = '/cabinet/user/read/offers';

    /**
     * @var string|null
     */
    protected $adminUrl = '/administration/offers/read/list';

    /**
     * @var string
     */
    protected $method = 'PUT';

    /**
     * @var array
     */
    protected $filters = ['merchantManagerId', 'categoryId', 'mainFilterItem', 'dateInsertedFrom', 'dateInsertedTo', 'active', 'types', 'fields', 'offset', 'limit', 'orderByField', 'orderByMethod'];

    /**
     * OffersRequestContent constructor.
     * @param BuilderInterface $builder
     * @param string|null $authToken
     */
    public function __construct(BuilderInterface $builder, $authToken = null)
    {
        $this->activeFilters = $builder->toArray();
        $this->authToken = $authToken;
    }
}
