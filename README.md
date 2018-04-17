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

```php
/* создаем соединение */
$connection = new \linkprofit\Tracker\Connection();

/* указываем параметры соединения */
$connection->userName = '';
$connection->userPassword = '';
$connection->apiUrl = '';
$connection->accessLevel = \linkprofit\Tracker\AccessLevel::USER;

/* создаем клиент и подключаемся к трекеру */
$client = new \linkprofit\Tracker\Client($connection);
$client->connect();

/* формируем запрос */
$offers = new \linkprofit\Tracker\builder\ReadOffersBuilder();
$offers = $offers->isActive()->limit(10)->createRoute();

/* получаем оффера */
$response = $client->exec($offers);
$response->handle()
```

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

