<?php

namespace linkprofit\Tracker\request;

use linkprofit\Tracker\exception\ReadUserBaseInfoExceptionHandler;

class ReadUserBaseInfoQuery extends BaseRoute
{
    /**
     * @var string|null
     */
    protected $userUrl = '/cabinet/user/read/base';

    /**
     * @var string|null
     */
    protected $adminUrl;

    /**
     * @var string
     */
    protected $method = 'PUT';

    /**
     * @return ReadUserBaseInfoExceptionHandler
     */
    public function getExceptionHandler()
    {
        return new ReadUserBaseInfoExceptionHandler();
    }
}
