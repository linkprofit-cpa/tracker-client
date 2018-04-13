<?php

namespace linkprofit\Tracker\request;

use linkprofit\Tracker\AccessLevel;

/**
 * Class BaseRequestContent
 *
 * @package linkprofit\Tracker\request
 */
abstract class BaseRequestContent implements RequestContentInterface
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
     * @var int
     */
    protected $accessLevel;

    /**
     * @var string
     */
    protected $authToken;

    /**
     * @var string
     */
    protected $userUrl;

    /**
     * @var string
     */
    protected $adminUrl;

    /**
     * @var string
     */
    protected $method;

    /**
     * @var array
     */
    protected $required = [];

    /**
     * @var array
     */
    protected $filters = [];

    /**
     * @var array
     */
    protected $activeFilters = [];

    /**
     * @return string|null
     */
    public function getUrl()
    {
        $this->url = ($this->accessLevel === AccessLevel::ADMIN) ? $this->adminUrl : $this->userUrl;

        return $this->url;
    }

    /**
     * @param $accessLevel
     */
    public function setAccessLevel($accessLevel)
    {
        $this->accessLevel = $accessLevel;
    }

    /**
     * @param null $authToken
     */
    public function setAuthToken($authToken = null)
    {
        $this->authToken = $authToken;
    }

    /**
     * @return bool|string
     */
    public function getBody()
    {
        if (!$this->checkRequired()) {
            return false;
        }

        $allowedParams = array_merge($this->filters, $this->required);
        foreach ($this->activeFilters as $filterName => $filterValue) {
            if (in_array($filterName, $allowedParams, true)) {
                $this->body[$filterName] = $filterValue;
            }
        }

        if ($this->authToken !== null) {
            $this->body['authToken'] = $this->authToken;
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
