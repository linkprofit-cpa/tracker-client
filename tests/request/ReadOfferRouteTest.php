<?php

namespace linkprofit\AmoCRM\tests\request;

use linkprofit\Tracker\AccessLevel;
use linkprofit\Tracker\builder\ReadOfferBuilder;
use linkprofit\Tracker\tests\providers\ReadOfferRouteProvider;
use linkprofit\Tracker\tests\providers\ReadOffersRouteProvider;
use PHPUnit\Framework\TestCase;

class ReadOfferRouteTest extends TestCase
{
    /**
     * @var ReadOffersRouteProvider
     */
    public $offer;

    public function testUrl()
    {
        $content = $this->offer->get();
        $this->assertEquals($content->getUrl(), '/cabinet/user/read/offer');

        $content->setAccessLevel(AccessLevel::ADMIN);
        $this->assertEquals($content->getUrl(), '/administration/offer/read');
    }

    public function testGetMethod()
    {
        $content = $this->offer->get();
        $this->assertEquals('PUT', $content->getMethod());
    }

    public function testGetBody()
    {
        $rightBody = [
            'offerId' => '1ee34g',
        ];

        $content = $this->offer->get();
        $this->assertEquals(json_encode($rightBody), $content->getBody());

        $content->setAuthToken('nice_token');
        $this->assertEquals(json_encode(array_merge($rightBody, ['authToken' => 'nice_token'])), $content->getBody());

        $content = new ReadOfferRouteProvider();
        $this->assertEquals(null, $content->getEmpty()->getBody());
    }

    public function testGetHash()
    {
        $content = new ReadOfferBuilder();
        $secondContent = new ReadOfferBuilder();

        $content->offerId('gh345');
        $secondContent->offerId('gh345');

        $requestContent = $content->createRoute();
        $secondRequestContent = $secondContent->createRoute();

        $this->assertEquals($requestContent->getHash(), $secondRequestContent->getHash());

        $requestContent->setAccessLevel(AccessLevel::ADMIN);

        $this->assertNotEquals($requestContent->getHash(), $secondRequestContent->getHash());

        $secondContent->offerId('das346g');

        $this->assertNotEquals($content->createRoute()->getHash(), $secondContent->createRoute()->getHash());
    }

    public function setUp()
    {
        $this->offer = new ReadOfferRouteProvider();
    }

    public function invokeMethod(&$object, $methodName, array $parameters = array())
    {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }
}
