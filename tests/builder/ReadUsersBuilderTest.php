<?php

use PHPUnit\Framework\TestCase;
use linkprofit\Tracker\builder\ReadUsersBuilder;
use linkprofit\Tracker\request\ReadUsersRoute;

class ReadUsersBuilderTest extends TestCase
{
    public function testToArray()
    {
        $builder = new ReadUsersBuilder();
        $this->assertEquals([], $builder->toArray());

        $builder->statuses(['a', 'p'])->fields(['apiKey', 'refId'])->limit(5);
        $this->assertEquals(['fields' => ['apikey', 'refid'], 'statuses' => ['A', 'P'], 'limit' => 5], $builder->toArray());
    }

    public function testCreateRequestContent()
    {
        $builder = new ReadUsersBuilder();
        $builder->statuses(['a', 'p'])->fields(['apiKey', 'refId'])->limit(5);

        $this->assertInstanceOf(ReadUsersRoute::class, $builder->createRoute());
    }
}
