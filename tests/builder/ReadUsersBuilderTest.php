<?php

use PHPUnit\Framework\TestCase;
use linkprofit\Tracker\builder\ReadUsersBuilder;
use linkprofit\Tracker\request\ReadUsersQuery;

class ReadUsersBuilderTest extends TestCase
{
    public function testToArray()
    {
        $builder = new ReadUsersBuilder();
        $this->assertEquals([], $builder->toArray());

        $builder->statuses(['a', 'p'])->fields(['apiKey', 'refId'])
            ->limit(5)->offset(1)->accountManagerId(2)
            ->dateInsertedFrom(strtotime('10 December 2017'))->dateInsertedTo(strtotime('10 February 2018'))
            ->orderByMethod(SORT_ASC)->orderByField('phone')->mainFilterItem('sample');

        $this->assertEquals(['fields' => ['apikey', 'refid'], 'statuses' => ['A', 'P'], 'limit' => 5, 'offset' => 1,
            'accountManagerId' => 2, 'dateInsertedFrom' => '10.12.2017', 'dateInsertedTo' => '10.02.2018',
            'orderByMethod' => 'ASC', 'orderByField' => 'phone', 'mainFilterItem' => 'sample'],
        $builder->toArray());

        $builder->dateInsertedTo();
        $this->assertNotNull($builder->params['dateInsertedTo']);

        $builder->dateInsertedFrom();
        $this->assertNotNull($builder->params['dateInsertedTo']);
    }

    public function testCreateRequestContent()
    {
        $builder = new ReadUsersBuilder();
        $builder->statuses(['a', 'p'])->fields(['apiKey', 'refId'])->limit(5);

        $this->assertInstanceOf(ReadUsersQuery::class, $builder->createRoute());
    }
}
