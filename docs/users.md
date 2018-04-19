# Пользователи

## Получение пользователей

```php
$builder = new \linkprofit\Tracker\builder\ReadUsersBuilder();
$route = $builder->statuses(['a', 'p'])->fields(['apiKey', 'refId'])
                   ->limit(5)->offset(1)->accountManagerId(2)
                   ->dateInsertedFrom(strtotime('10 December 2017'))->dateInsertedTo(strtotime('10 February 2018'))
                   ->orderByMethod(SORT_ASC)->orderByField('phone')
                   ->mainFilterItem('sample')
                   ->createRoute();
```
