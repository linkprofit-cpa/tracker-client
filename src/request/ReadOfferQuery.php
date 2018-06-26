<?php

namespace linkprofit\Tracker\request;
use linkprofit\Tracker\exception\ReadOfferExceptionHandler;

/**
 * Class ReadOfferQuery
 *
 * @package linkprofit\Tracker\request
 */
class ReadOfferQuery extends BaseRoute
{
    /**
     * @var string|null
     */
    protected $userUrl = '/cabinet/user/read/offer';

    /**
     * @var string|null
     */
    protected $adminUrl = '/administration/offer/read';

    /**
     * @var string
     */
    protected $method = 'PUT';

    /**
     * @var array
     */
    protected $required = ['authToken', 'offerId'];

    /**
     * @return ReadOfferExceptionHandler
     */
    public function getExceptionHandler()
    {
        return new ReadOfferExceptionHandler();
    }
}
