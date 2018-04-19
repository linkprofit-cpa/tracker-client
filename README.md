# Tracker Client

[![Latest Stable Version](https://poser.pugx.org/linkprofit-cpa/tracker-client/v/stable)](https://packagist.org/packages/linkprofit-cpa/tracker-client)
[![Build Status](https://travis-ci.org/linkprofit-cpa/tracker-client.svg?branch=master)](https://travis-ci.org/linkprofit-cpa/tracker-client)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/linkprofit-cpa/tracker-client/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/linkprofit-cpa/tracker-client/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/linkprofit-cpa/tracker-client/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/linkprofit-cpa/tracker-client/?branch=master)
[![License](https://poser.pugx.org/linkprofit-cpa/tracker-client/license)](https://packagist.org/packages/linkprofit-cpa/tracker-client)

## Описание

Библиотека для взаимодействия с API трекера cpa-сети LINKPROFIT

## Установка
`composer require linkprofit-cpa/tracker-client`

## Пример

### Создание соединения
```php
$connection = new \linkprofit\Tracker\Connection();

/* указываем параметры соединения */
$connection->userName = '';
$connection->userPassword = '';
$connection->apiUrl = '';
$connection->accessLevel = \linkprofit\Tracker\AccessLevel::USER;

/* создаем клиент и подключаемся к трекеру */
$client = new \linkprofit\Tracker\Client($connection);
$client->connect();
```

### Формируем запросы

[Для офферов](docs/offers.md)

[Для пользователей](docs/users.md)

[Для категорий](docs/categories.md)

### Выполняем запросы и получаем данные

```php
$response = $client->exec($route);
$response->handle();
```

## Дополнительные параметры

Вы можете использовать кеш, отвечающий `PSR-16` стандарту `simple-cache`

```php
$client->setCache($client->getDefaultFileCache());
```

Вы можете создать свой `ResponseHandler`, который имплементит `ResponseHandlerInterface`, трансформирующий ответ сервера в нужный вам формат. По умолчанию используется `ArrayResponseHandler`.

```php
$client->setResponseHandler(new ArrayResponseHandler());
```

## Лицензия

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE) file for details

