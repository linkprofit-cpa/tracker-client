<?php

namespace linkprofit\Tracker;

use GuzzleHttp\Psr7\Response;
use linkprofit\Tracker\response\ResponseHandlerInterface;

/**
 * Class ResponseHandler
 *
 * @package linkprofit\Tracker
 */
class ResponseHandler implements ResponseHandlerInterface
{
    /**
     * @var array
     */
    public $decodedArray = [];

    /**
     * @var Response
     */
    protected $response;

    /**
     * ResponseHandler constructor.
     * @param Response $response
     */
    public function __construct(Response $response)
    {
        $this->response = $response;
        $this->createArray();
    }

    /**
     * @return array
     */
    public function handle()
    {
        return $this->decodedArray;
    }

    /**
     * @return bool
     */
    public function isSuccess()
    {
        $isSuccess = isset($this->decodedArray['success']) && $this->decodedArray['success'] === true;

        return $isSuccess;
    }

    /**
     * Set $this->decodedArray
     */
    protected function createArray()
    {
        $jsonDecode = $this->jsonDecode();
        $this->decodedArray = is_array($jsonDecode) ?  $jsonDecode : [];
    }

    /**
     * @return mixed
     */
    protected function jsonDecode()
    {
        return json_decode($this->response->getBody(), 1);
    }
}
