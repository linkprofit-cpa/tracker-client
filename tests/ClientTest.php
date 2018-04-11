<?php

namespace linkprofit\AmoCRM\tests;

use linkprofit\Tracker\Client;
use linkprofit\Tracker\ResponseHandler;
use linkprofit\Tracker\tests\fakers\HttpClient;
use linkprofit\Tracker\tests\providers\ConnectionRequestContentProvider;
use linkprofit\Tracker\tests\providers\OffersRequestContentProvider;
use linkprofit\Tracker\tests\providers\ResponseProvider;
use PHPUnit\Framework\TestCase;
use linkprofit\Tracker\tests\providers\ConnectionProvider;

class ClientTest extends TestCase
{
    /**
     * @var ConnectionProvider
     */
    public $connection;

    /**
     * @var ConnectionRequestContentProvider
     */
    public $connectionContent;

    /**
     * @var ResponseProvider
     */
    public $response;


    /**
     * @var OffersRequestContentProvider
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

    public function testOfferExec()
    {
        $client = new Client($this->connection->getUser());
        $http = new HttpClient();
        $http->setResponse($this->response->getSuccess());
        $client->setHttpClient($http);

        $client->connect();

        $http->setResponse($this->response->getSuccess());
        $client->setHttpClient($http);
        $response = $client->exec($this->offers->get());

        $this->assertInstanceOf(ResponseHandler::class, $response);
        $this->assertTrue($response->isSuccess());
        $this->assertNotEmpty($response->toArray());
    }

    public function testErrorConnect()
    {
        $client = new Client($this->connection->getUser());

        $http = new HttpClient();
        $http->setResponse($this->response->getError());

        $client->setHttpClient($http);
        $this->assertFalse($client->connect());

        $this->assertNull($this->invokeMethod($client, 'getAuthToken'));
    }

    public function setUp()
    {
        $this->connection = new ConnectionProvider();
        $this->connectionContent = new ConnectionRequestContentProvider();
        $this->response = new ResponseProvider();
        $this->offers = new OffersRequestContentProvider();
    }

    public function invokeMethod(&$object, $methodName, array $parameters = array())
    {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }
}
