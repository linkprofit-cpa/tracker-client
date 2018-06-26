<?php

namespace linkprofit\Tracker\response;

use GuzzleHttp\Psr7\Response;
use linkprofit\Tracker\exception\ExceptionHandlerInterface;
use linkprofit\Tracker\exception\TrackerException;

/**
 * Interface ResponseHandlerInterface
 *
 * @package linkprofit\Tracker\response
 */
interface ResponseHandlerInterface
{
    /**
     * ResponseHandlerInterface constructor.
     *
     * @param Response|null $response
     */
    public function __construct(Response $response = null);

    /**
     * @param Response $response
     */
    public function add(Response $response);

    /**
     * @param ExceptionHandlerInterface $exceptionHandler
     * @return mixed
     */
    public function setExceptionHandler(ExceptionHandlerInterface $exceptionHandler);

    /**
     * @return mixed
     * @throws TrackerException
     */
    public function handle();
}
