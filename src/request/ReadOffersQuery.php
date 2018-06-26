<?php

namespace linkprofit\Tracker\request;
use linkprofit\Tracker\exception\ReadOffersExceptionHandler;

/**
 * Class OffersRequestQuery
 *
 * @package linkprofit\Tracker\request
 */
class ReadOffersQuery extends BaseRoute
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
     * @return ReadOffersExceptionHandler
     */
    public function getExceptionHandler()
    {
        return new ReadOffersExceptionHandler();
    }
}
