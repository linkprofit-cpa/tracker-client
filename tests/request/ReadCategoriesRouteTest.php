<?php

namespace linkprofit\AmoCRM\tests\request;

use linkprofit\Tracker\AccessLevel;
use linkprofit\Tracker\builder\ReadOfferBuilder;
use linkprofit\Tracker\request\ReadCategoriesRoute;
use linkprofit\Tracker\tests\providers\ReadOfferRouteProvider;
use linkprofit\Tracker\tests\providers\ReadOffersRouteProvider;
use PHPUnit\Framework\TestCase;

class ReadCategoriesRouteTest extends TestCase
{
    /**
     * @var ReadOffersRouteProvider
     */
    public $offer;

    public function testUrl()
    {
        $content = new ReadCategoriesRoute();
        $this->assertEquals($content->getUrl(), '/cabinet/user/read/all/categories');

        $content->setAccessLevel(AccessLevel::ADMIN);
        $this->assertEquals($content->getUrl(), '/administration/categories/read');
    }

    public function testGetMethod()
    {
        $content = new ReadCategoriesRoute();
        $this->assertEquals('PUT', $content->getMethod());
    }

    public function testGetBody()
    {
        $rightBody = [
            'authToken' => 'nice_token'
        ];

        $content = new ReadCategoriesRoute();
        $this->assertNull($content->getBody());

        $content->setAuthToken('nice_token');
        $this->assertEquals(json_encode($rightBody), $content->getBody());
    }

    public function testGetHash()
    {
        $content = new ReadCategoriesRoute();
        $secondContent = new ReadCategoriesRoute();

        $this->assertEquals($content->getHash(), $secondContent->getHash());

        $content->setAccessLevel(AccessLevel::ADMIN);

        $this->assertNotEquals($content->getHash(), $secondContent->getHash());
    }

    public function invokeMethod(&$object, $methodName, array $parameters = array())
    {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }
}
