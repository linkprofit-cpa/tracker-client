<?php

namespace linkprofit\AmoCRM\tests;

use linkprofit\Tracker\tests\providers\ResponseProvider;
use linkprofit\Tracker\ResponseHandler;
use PHPUnit\Framework\TestCase;

class ResponseHandlerTest extends TestCase
{
    /**
     * @var ResponseProvider
     */
    public $responseProvider;

    public function testIsSuccess()
    {
        $response = new ResponseHandler($this->responseProvider->getSuccess());
        $this->assertTrue($response->isSuccess());

        $response = new ResponseHandler($this->responseProvider->getError());
        $this->assertFalse($response->isSuccess());
    }

    public function testToArray()
    {
        $response = new ResponseHandler($this->responseProvider->getSuccess());
        $this->assertEquals($response->toArray(), ['success' => true, 'authToken' => 'nice_token']);

        $response = new ResponseHandler($this->responseProvider->getEmpty());
        $this->assertEquals($response->toArray(), []);
    }

    public function setUp()
    {
        $this->responseProvider = new ResponseProvider();
    }
}
