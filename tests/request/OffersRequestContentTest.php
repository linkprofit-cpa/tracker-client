<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11.04.18
 * Time: 14:22
 */

namespace linkprofit\AmoCRM\tests\request;

use linkprofit\Tracker\AccessLevel;
use linkprofit\Tracker\request\OffersRequestContent;
use linkprofit\Tracker\tests\providers\OffersRequestContentProvider;
use PHPUnit\Framework\TestCase;

class OffersRequestContentTest extends TestCase
{
    /**
     * @var OffersRequestContentProvider
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
            'offset' => 20
        ];

        $content = $this->offers->get();
        $this->assertEquals(json_encode($rightBody), $content->getBody());


        $content->setAuthToken('nice_token');
        $this->assertEquals(json_encode(array_merge($rightBody, ['authToken' => 'nice_token'])), $content->getBody());

        $content = new OffersRequestContentProvider();
        $this->assertEquals(json_encode([]), $content->getEmpty()->getBody());
    }

    public function setUp()
    {
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
