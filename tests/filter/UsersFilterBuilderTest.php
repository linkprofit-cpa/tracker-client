<?php

use PHPUnit\Framework\TestCase;
use linkprofit\Tracker\filter\UsersFilterBuilder;
use linkprofit\Tracker\request\ReadUsersRoute;

class UsersFilterBuilderTest extends TestCase
{
    public function testToArray()
    {
        $builder = new UsersFilterBuilder();
        $this->assertEquals([], $builder->toArray());

        $builder->statuses(['a', 'p'])->fields(['apiKey', 'refId'])->limit(5);
        $this->assertEquals(['fields' => ['apikey', 'refid'], 'statuses' => ['A', 'P'], 'limit' => 5], $builder->toArray());
    }

    public function testCreateRequestContent()
    {
        $builder = new UsersFilterBuilder();
        $builder->statuses(['a', 'p'])->fields(['apiKey', 'refId'])->limit(5);

        $this->assertInstanceOf(ReadUsersRoute::class, $builder->createRoute());
    }
}
