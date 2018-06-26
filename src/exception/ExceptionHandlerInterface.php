<?php

namespace linkprofit\Tracker\exception;

/**
 * Interface ExceptionHandlerInterface
 * @package linkprofit\Tracker\exception
 */
interface ExceptionHandlerInterface
{
    /**
     * @param $errorCode
     * @throws TrackerException
     */
    public function handle($errorCode);
}