# gazmendsahiti/CcPointe

CcPointe is a lightweight package/library  to interact with CardConnect's API (CardPointe) in a simple/fluent way.

## Installation via composer
Requires PHP >= 8.1 to run
```shell
composer require gazmendsahiti/CcPointe
```


## List of available methods

To get started as fast as possible, please check CardPointe's docs, you may see merchid is required in all instances I have already taken care of that you don't need to pass that parameter.
Note: Profile's endpoint is used to create profile, get profile, update profile and delete profile.
```sh
_________________________________________
| ENDPOINT          | METHOD            | 
|___________________|___________________|
| inquireMerchant   | inquireMerchant   |
| auth              | authorization     |
| capture           | capture           |
| void              | void              |
| refund            | refund            |
| inquire           | inquire           |
| inquireByOrderId  | inquireByOrderId  |
| voidByOrderId     | voidByOrderId     |
| settlestat        | settlementStatus  |
| funding           | funding           |
| profile           | createProfile     | 
| profile           | getProfile        |
| profile           | updateProfile     | 
| profile           | deleteProfile     | 
| sigcap            | signatureCapture  |
| bin               | bin               |
|_______________________________________|
```

## Code Examples
To use CcPointe first include it in your class/file using

```php
use gazmendsahiti\CcPointe\CardPointe;
```

```php
$cardPointe = new CardPointe($serviceUrl, $username, $password, $merchId);
// or
$cardPointe = new CardPointe::make($serviceUrl, $username, $password, $merchId);

$response = $cardPointe->authorization([
    'amount' => 255,
    // other parameters...
]);

// You can transform response to object or array
$objectResponse = $response->toObject();
$arrayResponse = $response->toArray()

// raw response from api
$raw = $response->rawResponse();
```

## License

MIT

