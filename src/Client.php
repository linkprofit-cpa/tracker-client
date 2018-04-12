<?php

namespace linkprofit\Tracker;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Request;
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
     * Используется для кэширования
     */
    const AUTH_TOKEN_KEY = 'trackerAuthToken';

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
     * @return ResponseHandlerInterface
     */
    public function exec(RequestContentInterface $requestContent)
    {
        if ($this->getAuthToken() === null) {
            $this->connect();
        }

        $requestContent->setAccessLevel($this->connection->getAccessLevel());
        $requestContent->setAuthToken($this->getAuthToken());
        $request = $this->createRequest($requestContent);

        $result = $this->httpClient->send($request);

        $this->responseHandler->add($result);

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
     * @param $authToken
     */
    protected function setAuthToken($authToken)
    {
        $this->connection->setAuthToken($authToken);

        if ($this->cache !== null) {
            $this->cache->set($this->getAuthTokenName(), $authToken);
        }
    }

    /**
     * @return string|null
     */
    protected function getAuthToken()
    {
        if ($this->cache !== null && $this->cache->has($this->getAuthTokenName())) {
            return $this->cache->get($this->getAuthTokenName());
        }

        return $this->connection->getAuthToken();
    }

    /**
     * @return string
     */
    protected function getAuthTokenName()
    {
        return self::AUTH_TOKEN_KEY . $this->connection->getAccessLevel();
    }
}
