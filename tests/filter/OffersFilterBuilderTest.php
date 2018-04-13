<?php

use PHPUnit\Framework\TestCase;
use linkprofit\Tracker\filter\OffersFilterBuilder;
use linkprofit\Tracker\request\OffersRequestContent;

class OffersFilterBuilderTest extends TestCase
{
    public function testToArray()
    {
        $builder = new OffersFilterBuilder();
        $this->assertEquals([], $builder->toArray());

        $builder->categoryId(1)->isActive()->limit(10)->offset(20)->orderByField('field');
        $this->assertEquals(['categoryId' => 1, 'active' => 1, 'limit' => 10, 'offset' => 20, 'orderByField' => 'field'], $builder->toArray());
    }

    public function testCreateRequestContent()
    {
        $builder = new OffersFilterBuilder();
        $builder->categoryId(1)->isActive()->limit(10)->offset(20)->orderByField('field');

        $this->assertInstanceOf(OffersRequestContent::class, $builder->createRequestContent());
    }
}
