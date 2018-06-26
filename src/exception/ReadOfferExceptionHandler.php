<?php

namespace linkprofit\Tracker\exception;

/**
 * Class ReadOfferExceptionHandler
 * @package linkprofit\Tracker\exception
 */
class ReadOfferExceptionHandler  extends BaseExceptionHandler
{
    protected $availableExceptions = [
        null, 110, 111, 112
    ];
}