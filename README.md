# Treasury PHP API Library



## Instalation
Install package with composer by following command:
```
composer require ryuamy/emas-trs-php
```


## Call Package
Add following code on your controller:
```php
use Ryuamy\EmasTrs;
```


## Usages

### Authentication

**Login Client**
```php
EmasTrs\Authentication::loginClient( bool $productionFlag, array $bodyParameters );
```
Example: 
```php
$bodyParameters = [
    'client_id' => '(Treasury client id)',
    'client_secret' => '(Treasury client secret)',
];

$loginClient = EmasTrs\Authentication::loginClient( true, $bodyParameters );

var_dump($loginClient);
```