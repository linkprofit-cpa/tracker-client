<?php

namespace linkprofit\Tracker\exception;

/**
 * Class BaseExceptionHandler
 * @package linkprofit\Tracker\exception
 */
abstract class BaseExceptionHandler implements ExceptionHandlerInterface
{
    /**
     * @var array
     */
    protected $availableExceptions = [];

    /**
     * @var array
     */
    protected $exceptionCodes = [
        null => 'Unknown success/error (success true/false)',
        101 => 'User not found (Пользователь с таким логином и паролем не найден в системе)',
        102 => 'User login is empty (Логин пользователя не был передан в систему для аутентификации)',
        103 => 'User password is empty (Пароль пользователя не был передан в систему для аутентификации)',
        107 => 'Employer login is empty (Логин сотрудника не был передан в систему для аутентификации)',
        108 => 'Employer password is empty (Пароль сотрудника не был передан в систему для аутентификации)',
        109 => 'Employer not found (Сотрудник с таким логином и паролем не найден в системе)',
        110 => 'User is not authorized (Пользователь не авторизован. Необходима авторизация.)',
        111 => 'Employer is not authorized (Сотрудник не авторизован, требуется повторная авторизация)',
        112 => 'Employer is not access to this area (Сотрудник не имеет доступа к данной операции)',
    ];

    /**
     * @param $errorCode
     * @throws TrackerException
     */
    public function handle($errorCode)
    {
        if (!in_array($errorCode, $this->availableExceptions)) {
            throw new TrackerException('Неизвестная ошибка', $errorCode);
        }

        throw new TrackerException($this->exceptionCodes[$errorCode], $errorCode);
    }
}