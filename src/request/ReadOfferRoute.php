<?php

namespace linkprofit\Tracker\request;

use linkprofit\Tracker\builder\BuilderInterface;

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
