<?php

namespace linkprofit\Tracker\response;

use GuzzleHttp\Psr7\Response;
use linkprofit\Tracker\exception\TrackerException;
use linkprofit\Tracker\exception\ExceptionHandlerInterface;

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
    public $decodedBody = [];

    /**
     * @var Response
     */
    protected $response;

    /**
     * @var ExceptionHandlerInterface
     */
    protected $exceptionHandler;

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
        $this->setDecodedBody();
    }

    /**
     * @return array|mixed
     * @throws TrackerException
     */
    public function handle()
    {
        try {
            $this->validateResponse();
        } catch (TrackerException $exception) {
            if ($this->exceptionHandler !== null) {
                $this->exceptionHandler->handle($exception->getCode());
            }

            throw $exception;
        }

        return $this->decodedBody;
    }

    /**
     * @param ExceptionHandlerInterface $exceptionHandler
     */
    public function setExceptionHandler(ExceptionHandlerInterface $exceptionHandler)
    {
        $this->exceptionHandler = $exceptionHandler;
    }

    /**
     * Set $this->decodedBody
     */
    protected function setDecodedBody()
    {
        $decodedJson = json_decode($this->response->getBody(), 1);
        $this->decodedBody = is_array($decodedJson) ? $decodedJson : [];
    }

    /**
     * @throws TrackerException
     */
    protected function validateResponse()
    {
        if ($this->response->getStatusCode() !== 200) {
            throw new TrackerException('Код ответа сервера: ' . $this->response->getStatusCode());
        }

        if (isset($this->decodedBody['code'])) {
            throw new TrackerException('', $this->decodedBody['code']);
        }
    }
}
