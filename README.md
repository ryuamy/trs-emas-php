# Treasury PHP API Third Party Library
using [Treasury](https://www.treasury.id/) API v2, please make sure Treasury API version and read API [procedure below](#procedure) for flow of registration and transaction.



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

#### Client Login
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
```

#### User Register
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
    'gender' => 'female',
    'birthday' => '1991-01-01',
    'referral_code' => '',
    'phone' => '081312345678',
    'security_question' => 'KQxz9YXazA14VEO',
    'security_question_answer' => 'Sebastian Michaelis',
    'selfie_scan' => '/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDAAEBAQ...',
    'id_card_scan' => '/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDAAEBAQ...',
    'owner_name' => 'Ryu Amy',
    'account_number' => '123456',
    'bank_code' => 'string',
    'branch' => 'Jakarta',
    'customer_concern' => false
];

$Tresury = TrsEmas\Authentication::register( true, $bodyParameters, '(Bearer Token)' );
```

#### User Login
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
TrsEmas\Transaction::goldRate( bool $productionFlag, array $bodyParameters, string $token );
```
Parameters: 
* productionFlag: if set to true, package will hit Treasury production API, false to hit Treasury staging API.
* bodyParameters: request body parameter.
* token: bearer token from user login.

Example: 
```php
$bodyParameters = [
    'start_date' => '2021-03-03 09:00:00',
    'end_date' => '2021-03-03 10:00:00'
];

$Tresury = TrsEmas\Transaction::goldRate( true, $bodyParameters, '(Bearer Token)' );
```

#### Calculate
```php
TrsEmas\Transaction::calculate( bool $productionFlag, array $bodyParameters, string $token );
```
Parameters: 
* productionFlag: if set to true, package will hit Treasury production API, false to hit Treasury staging API.
* bodyParameters: request body parameter.
* token: bearer token from user login.

Example: 
```php
$bodyParameters = [
    'amount_type' => 'gold',
    'amount' => '0.582',
    'transaction_type' => 'buy',
    'payment_type' => 'nett',
    'payment_method' => 'bca',
];

$Tresury = TrsEmas\Transaction::calculate( true, $bodyParameters, '(Bearer Token)' );
```

#### Payment Method
```php
TrsEmas\Transaction::paymentMethod( bool $productionFlag, string $token );
```
Parameters: 
* productionFlag: if set to true, package will hit Treasury production API, false to hit Treasury staging API.
* token: bearer token from user login.

Example: 
```php
$Tresury = TrsEmas\Transaction::paymentMethod( true, '(Bearer Token)' );
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
TrsEmas\Additional::securityQuestion( bool $productionFlag );
```
Parameters: 
* productionFlag: if set to true, package will hit Treasury production API, false to hit Treasury staging API.

Example: 
```php
$Tresury = TrsEmas\Additional::securityQuestion( true );
```



## Procedure

### Gold Transaction
To create gold transaction with treasury payment method, the following procedure is:
1. Get gold rate.
2. Calculate gold transaction with currency or unit. Gold unit support can be up to 4 digits.
3. Get payment method list to take payment_code response.
4. Do transactions with endpoints gold buy and sell gold.

To create gold transaction with partner payment method, the following procedure is:
1. Get gold rate.
2. Calculate gold transaction with currency or unit. Gold unit support can be up to 4 digits
3. Do transactions with endpoints gold buy and sell gold.
4. Hit endpoint payment notify to ensure payment has been successful.
