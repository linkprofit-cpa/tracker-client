<?php

namespace linkprofit\Tracker\filter;

use linkprofit\Tracker\request\RequestContentInterface;

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
     * @return RequestContentInterface
     */
    public function createRequestContent();
}
