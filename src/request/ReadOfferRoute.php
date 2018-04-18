<?php

namespace linkprofit\Tracker\request;

/**
 * Class ReadOfferRoute
 *
 * @package linkprofit\Tracker\request
 */
class ReadOfferRoute extends BaseRoute
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
    protected $required = ['offerId'];
}
