<?php

namespace linkprofit\Tracker;

use GuzzleHttp\Psr7\Response;

/**
 * Class ResponseHandler
 *
 * @package linkprofit\Tracker
 */
class ResponseHandler
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
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $jsonDecode = $this->jsonDecode();
        $this->decodedArray = is_array($jsonDecode) ?  $jsonDecode : [];

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
     * @return mixed
     */
    protected function jsonDecode()
    {
        return json_decode($this->response->getBody(), 1);
    }
}
