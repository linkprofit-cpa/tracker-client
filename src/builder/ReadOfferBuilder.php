<?php

namespace linkprofit\Tracker\builder;

use linkprofit\Tracker\request\ReadOfferRoute;

/**
 * Class ReadOfferBuilder
 *
 * @package linkprofit\Tracker\builder
 */
class ReadOfferBuilder implements BuilderInterface
{
    /**
     * @var array
     */
    public $params = [];

    /**
     * @return array
     */
    public function toArray()
    {
        return $this->params;
    }

    /**
     * @return ReadOfferRoute
     */
    public function createRoute()
    {
        return new ReadOfferRoute($this);
    }

    /**
     * @param $id
     *
     * @return $this
     */
    public function offerId($id)
    {
        $this->params['offerId'] = $id;

        return $this;
    }
}
