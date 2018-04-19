# Оффера

## Получение офферов

```php
$builder = new \linkprofit\Tracker\builder\ReadOffersBuilder();
$route = $builder->categoryId(1)->isActive()->limit(10)->offset(20)->orderByField('field')->merchantManagerId(2)->mainFilterItem('term')->createRoute();
```

## Получение одного оффера

```php
$builder = new \linkprofit\Tracker\builder\ReadOfferBuilder();
$route = $builder->offerId('reg3g2');
```
