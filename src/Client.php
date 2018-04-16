<?php

namespace linkprofit\Tracker;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use linkprofit\Tracker\request\ConnectionRequestContent;
use linkprofit\Tracker\request\RequestContentInterface;
use linkprofit\Tracker\response\ResponseHandlerInterface;
use linkprofit\Tracker\response\ArrayResponseHandler;
use Psr\SimpleCache\CacheInterface;
use duncan3dc\Cache\FilesystemPool;

/**
 * Class Client
 *
 * @package linkprofit\Tracker
 */
class Client
{
    /**
     * @var string
     */
    public $apiUrl;

    /**
     * @var ConnectionRequestContent
     */
    protected $connection;

    /**
     * @var CacheInterface
     */
    protected $cache;

    /**
     * @var \GuzzleHttp\Client|ClientInterface
     */
    protected $httpClient;

    /**
     * @var ResponseHandlerInterface
     */
    protected $responseHandler;

    /**
     * Client constructor.
     *
     * @param Connection $connection
     * @param ClientInterface|null $httpClient
     * @param ResponseHandlerInterface|null $responseHandler
     * @param CacheInterface|null $cache
     */
    public function __construct
    (
        Connection                  $connection,
        ClientInterface             $httpClient = null,
        ResponseHandlerInterface    $responseHandler = null,
        CacheInterface              $cache = null
    )
    {
        $this->connection = new ConnectionRequestContent($connection);
        $this->apiUrl = $connection->apiUrl;
        $this->httpClient = ($httpClient === null) ? $this->getDefaultHttpClient() : $httpClient;
        $this->responseHandler = ($responseHandler === null) ? $this->getDefaultResponseHandler() : $responseHandler;
        $this->cache = $cache;
    }

    /**
     * @param RequestContentInterface $requestContent
     * @return ResponseHandlerInterface|null
     */
    public function exec(RequestContentInterface $requestContent)
    {
        if ($this->getAuthToken() === null && $this->connect() === false) {
            return null;
        }

        $requestContent->setAccessLevel($this->connection->getAccessLevel());
        $requestContent->setAuthToken($this->getAuthToken());

        if ($this->cache !== null && $this->cache->has($requestContent->getHash())) {
            $response = $this->getResponseFromCache($requestContent->getHash());
        } else {
            $request = $this->createRequest($requestContent);
            $response = $this->httpClient->send($request);

            if ($this->cache !== null) {
                $this->setResponseToCache($response, $requestContent->getHash());
            }
        }

        $this->responseHandler->add($response);

        return $this->responseHandler;
    }

    /**
     * TODO сделать переподключение при ошибке N-ное кол-во раз
     *
     * @return bool
     */
    public function connect()
    {
        $request = $this->createRequest($this->connection);

        $result = $this->httpClient->send($request);

        $responseHandler = new ArrayResponseHandler($result);
        $response = $responseHandler->handle();

        if (isset($response['authToken']) && $responseHandler->isSuccess()) {
            $this->setAuthToken($response['authToken']);

            return true;
        }

        return false;
    }

    /**
     * @param CacheInterface $cache
     */
    public function setCache(CacheInterface $cache)
    {
        $this->cache = $cache;
    }

    /**
     * @param ClientInterface $httpClient
     */
    public function setHttpClient(ClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @param string $path
     *
     * @return FilesystemPool
     */
    public function getDefaultFileCache($path = null)
    {
        if ($path === null) {
            $path = dirname(__DIR__) . '/cache';
        }

        return new FilesystemPool($path);
    }

    /**
     * @return ArrayResponseHandler
     */
    public function getDefaultResponseHandler()
    {
        return new ArrayResponseHandler();
    }

    /**
     * @return \GuzzleHttp\Client
     */
    public function getDefaultHttpClient()
    {
        return new \GuzzleHttp\Client();
    }

    /**
     * @param RequestContentInterface $requestContent
     * @return Request
     */
    protected function createRequest(RequestContentInterface $requestContent)
    {
        $request = new Request(
            $requestContent->getMethod(),
            $this->apiUrl . $requestContent->getUrl(),
            $headers = [],
            $requestContent->getBody()
        );

        return $request;
    }

    /**
     * @param int $statusCode
     * @param array $headers
     * @param null $body
     *
     * @return Response
     */
    protected function createResponse($statusCode = 200, $headers = [], $body = null)
    {
        $response = new Response(
            $statusCode,
            $headers,
            $body
        );

        return $response;
    }

    /**
     * @param Response $response
     * @param $key
     */
    protected function setResponseToCache(Response $response, $key)
    {
        $value = json_encode([
            'statusCode' => $response->getStatusCode(),
            'headers' => $response->getHeaders(),
            'body' => (string) $response->getBody()
        ]);

        $this->cache->set($key, $value);
    }

    /**
     * @param $key
     *
     * @return Response|null
     */
    protected function getResponseFromCache($key)
    {
        $value = json_decode($this->cache->get($key), 1);

        if (is_array($value)) {
            return $this->createResponse($value['statusCode'], $value['headers'], $value['body']);
        }

        return null;
    }

    /**
     * @param $authToken
     */
    protected function setAuthToken($authToken)
    {
        $this->connection->setAuthToken($authToken);

        if ($this->cache !== null) {
            $this->cache->set($this->connection->getHash(), $authToken);
        }
    }

    /**
     * @return string|null
     */
    protected function getAuthToken()
    {
        $authTokenName = $this->connection->getHash();
        if ($this->cache !== null && $this->cache->has($authTokenName)) {
            return $this->cache->get($authTokenName);
        }

        return $this->connection->getAuthToken();
    }
}
