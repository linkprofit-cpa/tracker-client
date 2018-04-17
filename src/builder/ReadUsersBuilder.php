<?php

namespace linkprofit\Tracker\builder;

use linkprofit\Tracker\request\ReadUsersRoute;

/**
 * Class ReadUsersBuilder
 *
 * @package linkprofit\Tracker\filter
 */
class ReadUsersBuilder implements BuilderInterface
{
    /**
     * @var array
     */
    public $params = [];

    /**
     * @var array
     */
    private $allowedFields = [
        'userid', 'refid', 'username', 'apikey',
        'firstname', 'lastname', 'middlename',
        'topname', 'phone', 'city', 'regip',
        'dateinserted', 'datelastlogin',
        'status', 'commissionrate', 'managerid',
    ];

    /**
     * A — одобрен
     * P — в ожидании
     * D — отклонён
     *
     * @var array
     */
    private $allowedStatuses = [
        'A', 'P', 'D'
    ];

    /**
     * @return array
     */
    public function toArray()
    {
        return $this->params;
    }

    /**
     * @return ReadUsersRoute
     */
    public function createRoute()
    {
        return new ReadUsersRoute($this);
    }

    /**
     * @param $limit
     * @return $this
     */
    public function limit($limit)
    {
        $this->params['limit'] = $limit;

        return $this;
    }

    /**
     * @param array $fields
     *
     * @return $this
     */
    public function fields($fields = [])
    {
        if (!empty($fields)) {
            $this->params['fields'] = $this->getValidFieldsValues($fields);
        }

        return $this;
    }

    /**
     * @param array $statuses
     *
     * @return $this
     */
    public function statuses($statuses = [])
    {
        if (!empty($statuses)) {
            $this->params['statuses'] = $this->getValidStatuses($statuses);
        }

        return $this;
    }

    /**
     * @param array $fields
     *
     * @return array
     */
    protected function getValidFieldsValues($fields)
    {
        return array_values(array_intersect(array_map('strtolower', $fields), $this->allowedFields));
    }

    /**
     * @param $statuses
     *
     * @return array
     */
    protected function getValidStatuses($statuses)
    {
        return array_values(array_intersect(array_map('strtoupper', $statuses), $this->allowedStatuses));
    }
}
