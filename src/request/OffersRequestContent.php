<?php

namespace linkprofit\Tracker\request;

use linkprofit\Tracker\filter\FilterBuilderInterface;

/**
 * Class OffersRequestContent
 * @package linkprofit\Tracker\request
 */
class OffersRequestContent extends BaseRequestContent
{
    protected $config = [
        'userUrl' => '/cabinet/user/read/offers',
        'adminUrl' => '/administration/offers/read/list',
        'method' => 'PUT',
        'required' => [],
        'filters' => ['merchantManagerId','categoryId','mainFilterItem','dateInsertedFrom','dateInsertedTo','active','types','fields','offset','limit','orderByField','orderByMethod'],
    ];

    /**
     * OffersRequestContent constructor.
     * @param FilterBuilderInterface $filterBuilder
     * @param null $authToken
     */
    public function __construct(FilterBuilderInterface $filterBuilder, $authToken = null)
    {
        $this->filters = $filterBuilder->toArray();
        $this->authToken = $authToken;
    }
}