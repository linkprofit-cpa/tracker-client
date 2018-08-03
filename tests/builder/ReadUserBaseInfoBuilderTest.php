<?php

namespace linkprofit\Tracker\builder;

use linkprofit\Tracker\request\ReadUserBaseInfoQuery;
use PHPUnit\Framework\TestCase;

class ReadUserBaseInfoBuilderTest extends TestCase
{
    /** @var ReadUserBaseInfoBuilder */
    protected $object;

    public function setUp()
    {
        $this->object = new ReadUserBaseInfoBuilder();
    }

    public function testCreateRoute()
    {
        $expected = ReadUserBaseInfoQuery::class;
        $actual = $this->object->createRoute();

        $msg = 'ReadUserBaseInfoBuilder::createRoute() returns wrong result';
        $this->assertInstanceOf($expected, $actual, $msg);
    }
}
