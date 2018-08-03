<?php

namespace linkprofit\Tracker\request;

use linkprofit\Tracker\exception\ReadUserBaseInfoExceptionHandler;
use PHPUnit\Framework\TestCase;

class ReadUserBaseInfoQueryTest extends TestCase
{
    /** @var ReadUserBaseInfoQuery */
    protected $object;

    public function setUp()
    {
        $this->object = new ReadUserBaseInfoQuery();
    }

    public function testGetExceptionHandler()
    {
        $expected = ReadUserBaseInfoExceptionHandler::class;
        $actual = $this->object->getExceptionHandler();

        $msg = 'ReadUserBaseInfoQuery::getExceptionHandler() returns wrong result';
        $this->assertInstanceOf($expected, $actual, $msg);
    }
}
