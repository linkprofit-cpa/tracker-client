<?php

namespace linkprofit\AmoCRM\tests\request;

use linkprofit\Tracker\AccessLevel;
use linkprofit\Tracker\builder\ReadOffersBuilder;
use linkprofit\Tracker\tests\providers\ReadOffersRouteProvider;
use PHPUnit\Framework\TestCase;

class ReadOffersRouteTest extends TestCase
{
    /**
     * @var ReadOffersRouteProvider
     */
    public $offers;

    public function testUrl()
    {
        $content = $this->offers->get();
        $this->assertEquals($content->getUrl(), '/cabinet/user/read/offers');

        $content->setAccessLevel(AccessLevel::ADMIN);
        $this->assertEquals($content->getUrl(), '/administration/offers/read/list');
    }

    public function testGetMethod()
    {
        $content = $this->offers->get();
        $this->assertEquals('PUT', $content->getMethod());
    }

    public function testGetBody()
    {
        $rightBody = [
            'categoryId' => 1,
            'limit' => 1,
            'offset' => 20,
            'authToken' => 'nice_token'
        ];

        $content = $this->offers->get();
        $this->assertNull($content->getBody());

        $content->setAuthToken('nice_token');
        $this->assertEquals(json_encode($rightBody), $content->getBody());

        $content = new ReadOffersRouteProvider();
        $this->assertNull($content->getEmpty()->getBody());
    }

    public function testGetHash()
    {
        $content = new ReadOffersBuilder();
        $secondContent = new ReadOffersBuilder();

        $content->categoryId(1)->isActive()->limit(10);
        $secondContent->limit(10)->categoryId(1)->isActive();

        $requestContent = $content->createRoute();
        $secondRequestContent = $secondContent->createRoute();

        $this->assertEquals($requestContent->getHash(), $secondRequestContent->getHash());

        $requestContent->setAccessLevel(AccessLevel::ADMIN);

        $this->assertNotEquals($requestContent->getHash(), $secondRequestContent->getHash());

        $secondContent->offset(1);

        $this->assertNotEquals($content->createRoute()->getHash(), $secondContent->createRoute()->getHash());
    }

    public function setUp()
    {
        $this->offers = new ReadOffersRouteProvider();
    }

    public function invokeMethod(&$object, $methodName, array $parameters = array())
    {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }
}
