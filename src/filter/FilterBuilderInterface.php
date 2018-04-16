<?php

namespace linkprofit\Tracker\filter;

use linkprofit\Tracker\request\RouteInterface;

/**
 * Interface FilterBuilderInterface
 *
 * @package linkprofit\Tracker\filter
 */
interface FilterBuilderInterface
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
