<?php

namespace linkprofit\AmoCRM\tests\response;

use linkprofit\Tracker\response\ArrayResponseHandler;
use linkprofit\Tracker\tests\providers\ResponseProvider;
use PHPUnit\Framework\TestCase;

class ArrayResponseHandlerTest extends TestCase
{
    /**
     * @var ResponseProvider
     */
    public $responseProvider;

    public function testIsSuccess()
    {
        $response = new ArrayResponseHandler($this->responseProvider->getSuccess());
        $this->assertTrue($response->isSuccess());

        $response = new ArrayResponseHandler($this->responseProvider->getError());
        $this->assertFalse($response->isSuccess());
    }

    public function testHandle()
    {
        $response = new ArrayResponseHandler($this->responseProvider->getSuccess());
        $this->assertEquals($response->handle(), ['success' => true, 'authToken' => 'nice_token']);

        $response = new ArrayResponseHandler($this->responseProvider->getEmpty());
        $this->assertEquals($response->handle(), []);
    }

    public function setUp()
    {
        $this->responseProvider = new ResponseProvider();
    }
}
