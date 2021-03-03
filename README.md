# Treasury PHP API Third Party Library
using Treasury API v2, please make sure Treasury API version and read API [procedure below](#procedure) for flow of registration and transaction.



## Instalation
Install package with composer by following command:
```
composer require ryuamy/trs-emas-php
```


## Call Package
Add following code on your controller:
```php
use Ryuamy\TrsEmas;
```


## Usages

### Authentication

#### Login Client
```php
TrsEmas\Authentication::loginClient( bool $productionFlag, array $bodyParameters );
```
Parameters: 
* productionFlag: if set to true, package will hit Treasury production API, false to hit Treasury staging API.
* bodyParameters: request body parameter.

Example: 
```php
$bodyParameters = [
    'client_id' => '(Treasury client id)',
    'client_secret' => '(Treasury client secret)',
];

$Tresury = TrsEmas\Authentication::loginClient( true, $bodyParameters );

var_dump($Tresury);
```

#### Register Customer
```php
TrsEmas\Authentication::register( bool $productionFlag, array $bodyParameters, string $token );
```
Parameters: 
* productionFlag: if set to true, package will hit Treasury production API, false to hit Treasury staging API.
* bodyParameters: request body parameter.
* token: bearer token from client login.

Example: 
```php
$bodyParameters = [
    'name' => 'Ryu Amy',
    'email' => 'ryuamy.mail@gmail.com',
    'password' => '(My Password)',
    'password_confirmation' => '(My Password)',
    'gender' => 'female', //female or male
    'birthday' => '1991-01-01',
    'referral_code' => '', //leave empty if you don't have referral code
    'phone' => '081312345678',
    'security_question' => 'KQxz9YXazA14VEO', //id of API security question
    'security_question_answer' => 'Sebastian Michaelis',
    'selfie_scan' => '/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDAAEBAQ...', //optional //Base64
    'id_card_scan' => '/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDAAEBAQ...', //optional //Base64
    'owner_name' => 'Ryu Amy', //optional
    'account_number' => '123456', //optional
    'bank_code' => 'string', //optional //id of API security question
    'branch' => 'Jakarta', //optional
    'customer_concern' => false
];

$Tresury = TrsEmas\Authentication::register( true, $bodyParameters, '(Bearer Token)' );
```

#### Login Customer
```php
TrsEmas\Authentication::login( bool $productionFlag, array $bodyParameters );
```
Parameters: 
* productionFlag: if set to true, package will hit Treasury production API, false to hit Treasury staging API.
* bodyParameters: request body parameter.

Example: 
```php
$bodyParameters = [
    'client_id' => '(Treasury client id)',
    'client_secret' => '(Treasury client secret)',
    'email' => 'ryuamy.mail@gmail.com',
    'password' => '(My Password)',
];

$Tresury = TrsEmas\Authentication::login( true, $bodyParameters );
```

### Transaction

#### Gold Rate
```php
TrsEmas\Transaction::checkEmailAvailability( bool $productionFlag, array $bodyParameters );
```
Parameters: 
* productionFlag: if set to true, package will hit Treasury production API, false to hit Treasury staging API.
* bodyParameters: request body parameter.

Example: 
```php
$bodyParameters = [
    'email' => 'ryuamy.mail@gmail.com',
];

$Tresury = TrsEmas\Additional::checkEmailAvailability( true, $bodyParameters );
```

### Additional

#### Check Email Availability
```php
TrsEmas\Additional::checkEmailAvailability( bool $productionFlag, array $bodyParameters );
```
Parameters: 
* productionFlag: if set to true, package will hit Treasury production API, false to hit Treasury staging API.
* bodyParameters: request body parameter.

Example: 
```php
$bodyParameters = [
    'email' => 'ryuamy.mail@gmail.com',
];

$Tresury = TrsEmas\Additional::checkEmailAvailability( true, $bodyParameters );
```

#### Security Question
```php
TrsEmas\Additional::getSecurityQuestion( bool $productionFlag );
```
Parameters: 
* productionFlag: if set to true, package will hit Treasury production API, false to hit Treasury staging API.

Example: 
```php
$Tresury = TrsEmas\Additional::getSecurityQuestion( true );
```



## Procedure

## Gold Transaction
To create gold transaction with treasury payment method, the following procedure is:
1. Get gold price
2. Calculate gold transaction with currency or unit
3. Get payment method list to take payment_code response
STRICTLY CONFIDENTIAL – TREASURY API DOCUMENTATION 10
4. Do transactions with endpoints gold buy and sell gold

To create gold transaction with partner payment method, the following procedure is:
1. Get gold price
2. Calculate gold transaction with currency or unit
3. Do transactions with endpoints gold buy and sell gold
4. Hit endpoint payment notify to ensure payment has been successful
