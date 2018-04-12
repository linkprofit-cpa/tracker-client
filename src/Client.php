<?php

namespace linkprofit\Tracker;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Request;
use linkprofit\Tracker\request\ConnectionRequestContent;
use linkprofit\Tracker\request\RequestContentInterface;
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
     * @var ResponseHandler
     */
    protected $responseHandler;

    /**
     * Используется для кэширования
     */
    const AUTH_TOKEN_KEY = 'trackerAuthToken';

    /**
     * Client constructor.
     * @param Connection $connection
     * @param ClientInterface|null $httpClient
     * @param CacheInterface|null $cache
     */
    public function __construct
    (
        Connection          $connection,
        ClientInterface     $httpClient = null,
        CacheInterface      $cache = null
    )
    {
        $this->connection = new ConnectionRequestContent($connection);
        $this->apiUrl = $connection->apiUrl;

        if ($httpClient === null) {
            $httpClient = $this->getDefaultHttpClient();
        }

        $this->httpClient = $httpClient;
        $this->cache = $cache;
    }

    /**
     * @param RequestContentInterface $requestContent
     * @return ResponseHandler
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

        return new ResponseHandler($result);
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

        $responseHandler = new ResponseHandler($result);
        $response = $responseHandler->toArray();

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
