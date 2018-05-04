<?php

namespace linkprofit\Tracker\builder;

use linkprofit\Tracker\request\ReadOffersQuery;
use linkprofit\Tracker\request\ReadUsersQuery;

/**
 * Class ReadUsersBuilder
 *
 * @package linkprofit\Tracker\filter
 */
class ReadUsersBuilder extends BaseBuilder
{
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
     * @var array
     */
    private $allowedSorting = [
        SORT_DESC, SORT_ASC
    ];

    /**
     * @return ReadUsersQuery
     */
    public function createRoute()
    {
        $route = new ReadUsersQuery();
        $route->setActiveFilters($this->toArray());

        return $route;
    }

    /**
     * @param $limit
     *
     * @return $this
     */
    public function limit($limit)
    {
        $this->params['limit'] = $limit;

        return $this;
    }

    /**
     * @param $offset
     *
     * @return $this
     */
    public function offset($offset)
    {
        $this->params['offset'] = $offset;

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
     * @param integer $unixTime
     *
     * @return $this
     */
    public function dateInsertedFrom($unixTime = null)
    {
        if ($unixTime === null) {
            $unixTime = time();
        }

        $this->params['dateInsertedFrom'] = date('d.m.Y', $unixTime);

        return $this;
    }

    /**
     * @param integer $unixTime
     *
     * @return $this
     */
    public function dateInsertedTo($unixTime = null)
    {
        if ($unixTime === null) {
            $unixTime = time();
        }

        $this->params['dateInsertedTo'] = date('d.m.Y', $unixTime);

        return $this;
    }

    /**
     * @param $field
     *
     * @return $this
     */
    public function orderByField($field)
    {
        $this->params['orderByField'] = $field;

        return $this;
    }

    /**
     * @param $method
     *
     * @return $this
     */
    public function orderByMethod($method)
    {
        if (in_array($method, $this->allowedSorting, true)) {
            $method = ($method === SORT_ASC) ? 'ASC' : 'DESC';
        }

        $this->params['orderByMethod'] = $method;

        return $this;
    }

    /**
     * Like поиск по полям, поля не указываются
     *
     * @param string $term
     *
     * @return $this
     */
    public function mainFilterItem($term)
    {
        $this->params['mainFilterItem'] = (string) $term;

        return $this;
    }

    /**
     * @param integer $id
     *
     * @return $this
     */
    public function accountManagerId($id)
    {
        $this->params['accountManagerId'] = $id;

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
