<?php

namespace linkprofit\Tracker\response;

use GuzzleHttp\Psr7\Response;

/**
 * Class ArrayResponseHandler
 *
 * @package linkprofit\Tracker
 */
class ArrayResponseHandler implements ResponseHandlerInterface
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
     * ArrayResponseHandler constructor.
     *
     * @param Response|null $response
     */
    public function __construct(Response $response = null)
    {
        if ($response !== null) {
            $this->add($response);
        }
    }

    /**
     * @param Response $response
     */
    public function add(Response $response)
    {
        $this->response = $response;
        $this->createArray();
    }

    /**
     * @return array
     */
    public function handle()
    {
        $this->createArray();

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
