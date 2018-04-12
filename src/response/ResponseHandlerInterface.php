<?php

namespace linkprofit\Tracker\response;

use GuzzleHttp\Psr7\Response;

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
     * @return mixed
     */
    public function handle();

    /**
     * @return bool
     */
    public function isSuccess();
}
