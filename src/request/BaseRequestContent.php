<?php

namespace linkprofit\Tracker\request;

use linkprofit\Tracker\AccessLevel;

/**
 * Class BaseRequestContent
 * @package linkprofit\Tracker\request
 */
class BaseRequestContent implements RequestContentInterface
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
     * @var string
     */
    public $method;

    /**
     * @var array
     */
    protected $filters;

    /**
     * @var int
     */
    protected $accessLevel;

    /**
     * @var string
     */
    protected $authToken;

    /**
     * @var array
     */
    protected $config;

    /**
     * @return string|null
     */
    public function getUrl()
    {
        $this->url = ($this->accessLevel === AccessLevel::ADMIN) ? $this->config['adminUrl'] : $this->config['userUrl'];

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

        $allowedParams = array_merge($this->config['filters'], $this->config['required']);
        foreach ($this->filters as $filterName => $filterValue) {
            if (in_array($filterName, $allowedParams)) {
                $this->body[$filterName] = $filterValue;
            }
        }

        $this->body['authToken'] = $this->authToken;

        return json_encode($this->body);
    }

    /**
     * @return mixed
     */
    public function getMethod()
    {
        return $this->config['method'];
    }

    /**
     * @return bool
     */
    protected function checkRequired()
    {
        foreach ($this->config['required'] as $paramName) {
            if (!isset($this->filters[$paramName]) || !is_string($this->filters[$paramName])) {
                return false;
            }
        }

        return true;
    }
}