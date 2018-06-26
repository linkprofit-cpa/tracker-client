<?php

namespace linkprofit\Tracker\exception;

/**
 * Class ConnectionExceptionHandler
 * @package linkprofit\Tracker\exception
 */
class ConnectionExceptionHandler extends BaseExceptionHandler
{
    protected $availableExceptions = [
        101, 102, 103, 107, 108, 109
    ];
}