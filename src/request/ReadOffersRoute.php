<?php

namespace linkprofit\Tracker\request;

use linkprofit\Tracker\filter\FilterBuilderInterface;

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
    protected $filters = ['merchantManagerId','categoryId','mainFilterItem','dateInsertedFrom','dateInsertedTo','active','types','fields','offset','limit','orderByField','orderByMethod'];

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
