<?php

use PHPUnit\Framework\TestCase;
use linkprofit\Tracker\builder\ReadOfferBuilder;
use linkprofit\Tracker\request\ReadOfferQuery;

class ReadOfferBuilderTest extends TestCase
{
    public function testToArray()
    {
        $builder = new ReadOfferBuilder();
        $this->assertEquals([], $builder->toArray());

        $builder->offerId('1ee34g');
        $this->assertEquals(['offerId' => '1ee34g'], $builder->toArray());
    }

    public function testCreateRequestContent()
    {
        $builder = new ReadOfferBuilder();
        $builder->offerId('1ee34g');

        $this->assertInstanceOf(ReadOfferQuery::class, $builder->createRoute());
    }
}
