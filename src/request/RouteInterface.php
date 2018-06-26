<?php

namespace linkprofit\Tracker\request;

use linkprofit\Tracker\exception\ExceptionHandlerInterface;

/**
 * Interface RouteInterface
 *
 * @package linkprofit\Tracker\request
 */
interface RouteInterface
{
    /**
     * @return string|null
     */
    public function getUrl();

    /**
     * @return string|null
     */
    public function getBody();

    /**
     * @return string
     */
    public function getMethod();

    /**
     * @param $filters
     */
    public function setActiveFilters($filters);

    /**
     * @param $accessLevel
     */
    public function setAccessLevel($accessLevel);

    /**
     * @param $authToken
     */
    public function setAuthToken($authToken);

    /**
     * @return string
     */
    public function getHash();

    /**
     * @return ExceptionHandlerInterface
     */
    public function getExceptionHandler();
}
