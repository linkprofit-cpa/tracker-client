<?php

namespace linkprofit\Tracker\builder;

/**
 * Class BaseBuilder
 *
 * @package linkprofit\Tracker\builder
 */
abstract class BaseBuilder implements BuilderInterface
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
}
