<?php

namespace linkprofit\Tracker\request;

use linkprofit\Tracker\AccessLevel;

/**
 * Class BaseRoute
 *
 * @package linkprofit\Tracker\request
 */
abstract class BaseRoute implements RouteInterface
{
    /**
     * @var string
     */
    public $url;

    /**
     * @var array
     */
    public $body = [];

    /**
     * @var array
     */
    public $activeFilters = [];

    /**
     * @var int
     */
    protected $accessLevel;

    /**
     * @var string
     */
    protected $authToken;

    /**
     * @var string|null
     */
    protected $userUrl;

    /**
     * @var string|null
     */
    protected $adminUrl;

    /**
     * @var string
     */
    protected $method;

    /**
     * @var array
     */
    protected $required = ['authToken'];

    /**
     * @var array
     */
    protected $filters = [];

    /**
     * @return string|null
     */
    public function getUrl()
    {
        $this->url = ($this->accessLevel === AccessLevel::ADMIN) ? $this->adminUrl : $this->userUrl;

        return $this->url;
    }

    /**
     * @param array $filters
     */
    public function setActiveFilters($filters)
    {
        $this->activeFilters = $filters;
    }

    /**
     * @param $accessLevel
     */
    public function setAccessLevel($accessLevel)
    {
        $this->accessLevel = $accessLevel;
    }

    /**
     * @param string|null $authToken
     */
    public function setAuthToken($authToken = null)
    {
        $this->authToken = $authToken;
    }

    /**
     * @return null|string
     */
    public function getBody()
    {
        if ($this->authToken !== null) {
            $this->activeFilters['authToken'] = $this->authToken;
        }

        if (!$this->checkRequired()) {
            return null;
        }

        $allowedParams = array_merge($this->filters, $this->required);
        foreach ($this->activeFilters as $filterName => $filterValue) {
            if (in_array($filterName, $allowedParams, true)) {
                $this->body[$filterName] = $filterValue;
            }
        }

        if ($this->authToken !== null) {
            unset($this->activeFilters['authToken']);
        }

        return json_encode($this->body);
    }

    /**
     * @return mixed
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @return string
     */
    public function getHash()
    {
        ksort($this->activeFilters);

        return md5($this->getUrl() . json_encode($this->activeFilters));
    }

    /**
     * @return bool
     */
    protected function checkRequired()
    {
        foreach ($this->required as $paramName) {
            if (!isset($this->activeFilters[$paramName]) || !is_string($this->activeFilters[$paramName])) {
                return false;
            }
        }

        return true;
    }
}
