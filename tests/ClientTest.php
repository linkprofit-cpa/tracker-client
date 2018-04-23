<?php

namespace linkprofit\AmoCRM\tests;

use duncan3dc\Cache\FilesystemPool;
use linkprofit\Tracker\Client;
use linkprofit\Tracker\response\ArrayResponseHandler;
use linkprofit\Tracker\tests\fakers\HttpClient;
use linkprofit\Tracker\tests\providers\ConnectionRouteProvider;
use linkprofit\Tracker\tests\providers\ReadOffersRouteProvider;
use linkprofit\Tracker\tests\providers\ResponseProvider;
use PHPUnit\Framework\TestCase;
use linkprofit\Tracker\tests\providers\ConnectionProvider;
use org\bovigo\vfs\vfsStreamWrapper;
use org\bovigo\vfs\vfsStreamDirectory;
use org\bovigo\vfs\vfsStream;
use Symfony\Component\Cache\Simple\FilesystemCache;

class ClientTest extends TestCase
{
    /**
     * @var ConnectionProvider
     */
    public $connection;

    /**
     * @var ConnectionRouteProvider
     */
    public $connectionContent;

    /**
     * @var ResponseProvider
     */
    public $response;

    /**
     * @var ReadOffersRouteProvider
     */
    public $offers;

    public function testConstruct()
    {
        $client = new Client($this->connection->getUser());
        $this->assertEquals('http://api.ru', $client->apiUrl);
    }

    public function testCreateRequest()
    {
        $client = new Client($this->connection->getUser());

        $rightBody = [
            'userName' => 'user',
            'userPassword' => 'password'
        ];

        /* @var $request \GuzzleHttp\Psr7\Request */
        $request = $this->invokeMethod($client, 'createRequest', [$this->connectionContent->getUser()]);

        $this->assertEquals('PUT', $request->getMethod());
        $this->assertEquals(json_encode($rightBody), $request->getBody());
        $this->assertEquals('http://api.ru/authorization/user', $request->getUri());
    }

    public function testSuccessConnect()
    {
        $client = new Client($this->connection->getUser());

        $http = new HttpClient();
        $http->setResponse($this->response->getSuccess());

        $client->setHttpClient($http);
        $this->assertTrue($client->connect());

        $this->assertEquals('nice_token', $this->invokeMethod($client, 'getAuthToken'));
    }

    public function testTokenCache()
    {
        $path = vfsStream::url('cache');

        $client = new Client($this->connection->getUser());
        $http = new HttpClient();
        $http->setResponse($this->response->getSuccess());
        $client->setHttpClient($http);
        $client->setCache($client->getDefaultFileCache($path));
        $client->connect();

        $this->assertTrue(vfsStreamWrapper::getRoot()->hasChildren());

        unset($client);

        $client = new Client($this->connection->getUser());
        $client->setCache($client->getDefaultFileCache($path));

        $this->assertEquals('nice_token', $this->invokeMethod($client, 'getAuthToken'));

        unset($client);

        $client = new Client($this->connection->getAdmin());
        $client->setCache($client->getDefaultFileCache($path));

        $this->assertNull($this->invokeMethod($client, 'getAuthToken'));
    }

    public function testOfferExec()
    {
        $client = new Client($this->connection->getUser());
        $http = new HttpClient();
        $http->setResponse($this->response->getSuccess());
        $client->setHttpClient($http);
        $client->setResponseHandler(new ArrayResponseHandler());

        $client->connect();

        $http->setResponse($this->response->getSuccess());
        $client->setHttpClient($http);
        $response = $client->exec($this->offers->get());

        $this->assertInstanceOf(ArrayResponseHandler::class, $response);
        $this->assertTrue($response->isSuccess());
        $this->assertNotEmpty($response->handle());
    }

    public function testOfferCache()
    {
        $client = new Client($this->connection->getUser());
        $http = new HttpClient();
        $http->setResponse($this->response->getSuccess());
        $client->setHttpClient($http);
        $client->setCache($client->getDefaultFileCache(vfsStream::url('cache')));
        $client->connect();

        /* получаем "ответ" по офферам из нашего httpClient */
        $http->setResponse($this->response->getSuccessOffer());
        $client->setHttpClient($http);
        $client->exec($this->offers->get());

        /* задаем нулевой ответ в нашем httpClient, чтоб убедиться что данные возьмутся не из него, а из кэша */
        $http->setResponse($this->response->getEmpty());
        $client->setHttpClient($http);
        $response = $client->exec($this->offers->get());

        $this->assertInstanceOf(ArrayResponseHandler::class, $response);
        $this->assertTrue($response->isSuccess());
        $this->assertNotEmpty($response->handle());
    }

    public function testErrorConnect()
    {
        $client = new Client($this->connection->getUser());

        $http = new HttpClient();
        $http->setResponse($this->response->getError());

        $client->setHttpClient($http);
        $this->assertFalse($client->connect());

        $this->assertNull($this->invokeMethod($client, 'getAuthToken'));
        $this->assertNull($client->exec($this->offers->get()));
    }

    public function testErrorGetResponseFromCache()
    {
        $client = new Client($this->connection->getUser());
        $client->setCache($client->getDefaultFileCache(vfsStream::url('cache')));
        $this->assertNull($this->invokeMethod($client, 'getResponseFromCache', ['fakeKey']));
    }

    public function testGetDefaultFileCache()
    {
        $expectedPath = dirname(__DIR__) . '/cache';
        $toDelete = is_dir($expectedPath) ? false : true;

        $client = new Client($this->connection->getUser());
        $fileCache = $this->invokeMethod($client, 'getDefaultFileCache');
        $this->assertInstanceOf(FilesystemCache::class, $fileCache);

        if ($toDelete) {
            rmdir($expectedPath);
        }
    }

    public function setUp()
    {
        $this->connection = new ConnectionProvider();
        $this->connectionContent = new ConnectionRouteProvider();
        $this->response = new ResponseProvider();
        $this->offers = new ReadOffersRouteProvider();

        vfsStreamWrapper::register();
        vfsStreamWrapper::setRoot(new vfsStreamDirectory('cache'));
    }

    public function invokeMethod(&$object, $methodName, array $parameters = array())
    {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }
}
