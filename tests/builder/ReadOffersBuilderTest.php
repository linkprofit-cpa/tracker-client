<?php

use PHPUnit\Framework\TestCase;
use linkprofit\Tracker\builder\ReadOffersBuilder;
use linkprofit\Tracker\request\ReadOffersRoute;

class ReadOffersBuilderTest extends TestCase
{
    public function testToArray()
    {
        $builder = new ReadOffersBuilder();
        $this->assertEquals([], $builder->toArray());

        $builder->categoryId(1)->isActive()->limit(10)->offset(20)->orderByField('field')->merchantManagerId(2)->mainFilterItem('term');
        $this->assertEquals(['categoryId' => 1, 'active' => 1, 'limit' => 10, 'offset' => 20, 'orderByField' => 'field', 'merchantManagerId' => 2, 'mainFilterItem' => 'term'], $builder->toArray());
    }

    public function testCreateRequestContent()
    {
        $builder = new ReadOffersBuilder();
        $builder->categoryId(1)->isActive()->limit(10)->offset(20)->orderByField('field');

        $this->assertInstanceOf(ReadOffersRoute::class, $builder->createRoute());
    }
}
