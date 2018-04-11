<?php

namespace linkprofit\Tracker\tests\fakers;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Promise\PromiseInterface;
use GuzzleHttp\Psr7\Response;
use linkprofit\Tracker\tests\providers\ResponseProvider;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;

class HttpClient implements ClientInterface
{
    protected $response;

    public function send(RequestInterface $request, array $options = [])
    {
        return $this->response;
    }

    public function sendAsync(RequestInterface $request, array $options = [])
    {
        // TODO: Implement sendAsync() method.
    }

    public function request($method, $uri, array $options = [])
    {
        // TODO: Implement request() method.
    }

    public function requestAsync($method, $uri, array $options = [])
    {
        // TODO: Implement requestAsync() method.
    }

    public function getConfig($option = null)
    {
        // TODO: Implement getConfig() method.
    }

    public function setResponse(Response $response)
    {
        $this->response = $response;
    }
}
