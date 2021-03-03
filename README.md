# Treasury PHP API Third Party Library
using [Treasury](https://www.treasury.id/) API v2, please make sure Treasury API version you gonna use and read API [procedure below](#procedure) for flow of registration and transaction.



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


## Usages and Example

Parameters detail: 
* productionFlag: if set to true, package will hit Treasury production API, false to hit Treasury staging API.
* bodyParameters: request body parameter.
* token: bearer token from client login (for User Register) or user login (for the rest of API).

### Authentication

#### Client Login
```php
$bodyParameters = [
    'client_id' => '(Treasury client id)',
    'client_secret' => '(Treasury client secret)',
];

$Tresury = TrsEmas\Authentication::loginClient( true, $bodyParameters );
```

#### User Register
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
$bodyParameters = [
    'start_date' => '2021-03-03 09:00:00',
    'end_date' => '2021-03-03 10:00:00'
];

$Tresury = TrsEmas\Transaction::goldRate( true, $bodyParameters, '(Bearer Token)' );
```

#### Calculate Buy Amount Type Currency
```php
$bodyParameters = [
    'amount_type' => 'currency',
    'amount' => 400000,
    'payment_method' => 'bca',
];

$Tresury = TrsEmas\Transaction::calculateBuy( true, $bodyParameters, '(Bearer Token)' );
```

#### Calculate Buy Amount Type Gold
```php
$bodyParameters = [
    'amount_type' => 'gold',
    'amount' => 0.582,
    'payment_method' => 'bca',
];

$Tresury = TrsEmas\Transaction::calculateBuy( true, $bodyParameters, '(Bearer Token)' );
```

#### Calculate Sell Amount Type Currency
```php
$bodyParameters = [
    'amount_type' => 'currency',
    'amount' => 50000,
];

$Tresury = TrsEmas\Transaction::calculateSell( true, $bodyParameters, '(Bearer Token)' );
```

#### Calculate Sell Amount Type Gold
```php
$bodyParameters = [
    'amount_type' => 'gold',
    'amount' => 0.015,
];

$Tresury = TrsEmas\Transaction::calculateSell( true, $bodyParameters, '(Bearer Token)' );
```

#### Calculate Buy Amount Type Currency For Partner
```php
$bodyParameters = [
    'amount_type' => 'currency',
    'amount' => 400000,
];

$Tresury = TrsEmas\Transaction::calculateBuyPartner( true, $bodyParameters, '(Bearer Token)' );
```

#### Calculate Buy Amount Type Gold For Partner
```php
$bodyParameters = [
    'amount_type' => 'gold',
    'amount' => 0.582,
];

$Tresury = TrsEmas\Transaction::calculateBuyPartner( true, $bodyParameters, '(Bearer Token)' );
```

#### Calculate Sell Amount Type Currency For Partner
```php
$bodyParameters = [
    'amount_type' => 'currency',
    'amount' => 50000,
];

$Tresury = TrsEmas\Transaction::calculateSellPartner( true, $bodyParameters, '(Bearer Token)' );
```

#### Calculate Sell Amount Type Gold For Partner
```php
$bodyParameters = [
    'amount_type' => 'gold',
    'amount' => 0.015,
];

$Tresury = TrsEmas\Transaction::calculateSellPartner( true, $bodyParameters, '(Bearer Token)' );
```

#### Payment Method
```php
$Tresury = TrsEmas\Transaction::paymentMethod( true, '(Bearer Token)' );
```

#### Buy Gold
```php
$bodyParameters = [
    'unit' => 1.8766253,
    'total' => 796169,
    'payment_channel' => 'BRIN',
    'latitude' => '-6.914744',
    'longitude' => '107.609810'
];

$Tresury = TrsEmas\Transaction::buy( true, $bodyParameters, '(Bearer Token)' );
```

#### Buy Gold For Partner
```php
$bodyParameters = [
    'invoice_number' => 'TRS42154451',
    'unit' => 1.8766253,
    'total' => 796169,
    'payment_channel' => 'BRIN',
    'latitude' => '-6.914744',
    'longitude' => '107.609810'
];

$Tresury = TrsEmas\Transaction::buyPartner( true, $bodyParameters, '(Bearer Token)' );
```

#### Sell Gold
```php
$bodyParameters = [
    'total' => 31587,
    'unit' => 0.0432,
    'latitude' => '-6.914744',
    'longitude' => '107.609810'
];

$Tresury = TrsEmas\Transaction::sell( true, $bodyParameters, '(Bearer Token)' );
```

#### Payment Notify For Partner
```php
$bodyParameters = [
    'invoice_number' => 'TRS42154451',
    'payment_note' => 'Payment to BRI'
];

$Tresury = TrsEmas\Transaction::paymentNotify( true, $bodyParameters, '(Bearer Token)' );
```

#### Apply Voucer Buy Gold
```php
$bodyParameters = [
    'code' => 'TRSVCR1',
];

$Tresury = TrsEmas\Transaction::applyVoucher( true, $bodyParameters, '(Bearer Token)' );
```

### Additional

#### Check Email Availability
```php
$bodyParameters = [
    'email' => 'ryuamy.mail@gmail.com',
];

$Tresury = TrsEmas\Additional::checkEmailAvailability( true, $bodyParameters );
```

#### Security Question
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
