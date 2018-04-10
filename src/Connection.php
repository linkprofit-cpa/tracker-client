<?php

namespace linkprofit\Tracker;

/**
 * Class Connection
 * @package linkprofit\Tracker
 */
class Connection
{
    /**
     * @var string
     */
    public $apiUrl;

    /**
     * @var string
     */
    public $userName;

    /**
     * @var string
     */
    public $userPassword;

    /**
     * @var int
     */
    public $accessLevel;

    /**
     * Connection constructor.
     * @param null $userName
     * @param null $userPassword
     * @param null $apiUrl
     * @param int $accessLevel
     */
    public function __construct($userName = null, $userPassword = null, $apiUrl = null, $accessLevel = AccessLevel::USER)
    {
        $this->userName = $userName;
        $this->userPassword = $userPassword;
        $this->apiUrl = $apiUrl;
        $this->accessLevel = $accessLevel;
    }

    /**
     * @return string
     */
    public function getApiUrl()
    {
        return $this->apiUrl;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'userName' => $this->userName,
            'userPassword' => $this->userPassword
        ];
    }
}