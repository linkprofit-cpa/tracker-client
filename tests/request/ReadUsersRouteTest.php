<?php

namespace linkprofit\AmoCRM\tests\request;

use linkprofit\Tracker\AccessLevel;
use linkprofit\Tracker\builder\ReadUsersBuilder;
use linkprofit\Tracker\tests\providers\ReadOffersQueryProvider;
use linkprofit\Tracker\tests\providers\ReadUsersQueryProvider;
use PHPUnit\Framework\TestCase;

class ReadUsersRouteTest extends TestCase
{
    /**
     * @var ReadUsersQueryProvider
     */
    public $users;

    public function testUrl()
    {
        $content = $this->users->get();
        $this->assertEquals($content->getUrl(), null);

        $content->setAccessLevel(AccessLevel::ADMIN);
        $this->assertEquals($content->getUrl(), '/administration/read/users/list');
    }

    public function testGetMethod()
    {
        $content = $this->users->get();
        $this->assertEquals('PUT', $content->getMethod());
    }

    public function testGetBody()
    {
        $rightBody = [
            'statuses' => ['A', 'P'],
            'fields' => ['apikey', 'refid'],
            'limit' => 5,
            'authToken' => 'nice_token'
        ];

        $content = $this->users->get();
        $this->assertNull($content->getBody());

        $content->setAuthToken('nice_token');
        $this->assertEquals(json_encode($rightBody), $content->getBody());

        $content = new ReadOffersQueryProvider();
        $this->assertNull($content->getEmpty()->getBody());
    }

    public function testGetHash()
    {
        $content = new ReadUsersBuilder();
        $secondContent = new ReadUsersBuilder();

        $content->statuses(['a', 'p'])->fields(['apiKey', 'refId'])->limit(5);
        $secondContent->fields(['apiKey', 'refId'])->limit(5)->statuses(['a', 'p']);

        $requestContent = $content->createRoute();
        $secondRequestContent = $secondContent->createRoute();

        $this->assertEquals($requestContent->getHash(), $secondRequestContent->getHash());

        $requestContent->setAccessLevel(AccessLevel::ADMIN);

        $this->assertNotEquals($requestContent->getHash(), $secondRequestContent->getHash());

        $secondContent->limit(4);

        $this->assertNotEquals($content->createRoute()->getHash(), $secondContent->createRoute()->getHash());
    }

    public function setUp()
    {
        $this->users = new ReadUsersQueryProvider();
    }

    public function invokeMethod(&$object, $methodName, array $parameters = array())
    {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }
}
