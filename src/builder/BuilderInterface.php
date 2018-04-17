<?php

namespace linkprofit\Tracker\builder;

use linkprofit\Tracker\request\RouteInterface;

/**
 * Interface BuilderInterface
 *
 * @package linkprofit\Tracker\builder
 */
interface BuilderInterface
{
    /**
     * Должен возвращать ассоциативный массив, где key это название фильтра, а value это его значение
     *
     * @return array
     */
    public function toArray();

    /**
     * @return RouteInterface
     */
    public function createRoute();
}
