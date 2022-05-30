# PHP JWT
A simple, fast HS256 JWT(JSON Web Token) implementation in PHP.  Since the [rfc7519](https://datatracker.ietf.org/doc/html/rfc7519#section-8)
only requires to implement "HS256" and "none" and "none" is not a secure token, HS256 should cover most of the use cases.
If you just want to encode/decode a spec compliant JWT, this project is definitely what you want.

## Installation
Since it does not available as a composer/pecl package.  You can just copy ```jwt.php``` to your project's library directory
and import it using ```require_once```.

## Quick Start
```php
<?php
require_once 'jwt.php';

$key = 'I love PHP!';

/* Encode using array */
$jwt = jwt_encode(['foo' => 'bar', 'bar' => 1234567890], $key);
echo $jwt . PHP_EOL;

/* Encode using JSON string */
$jwt = jwt_encode('{"foo":"bar","bar":1234567890}', $key);

/* Decode */
$json_object = jwt_decode('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJmb28iOiJiYXIiLCJiYXIiOjEyMzQ1Njc4OTB9.yxaKARhiuhCElP3cnj3KFtgQamqZcBktBGjcXIxspC8', $key);
```

## Benchmark
According to the [benchmark script](benchmark/benchmark.php), the implementation is about 50% faster than firebase's when benchmarking on MacBook Pro 13 2020.
```
[william@localhost benchmark]% php benchmark.php
jwt_encode() and jwt_decode() took 0.67081594467163 second(s)
JWT::encode() and JWT::decode() took 1.0407769680023 second(s)
The implementation is 1.55 time(s) faster than firebase

[william@localhost benchmark]% php benchmark.php
jwt_encode() and jwt_decode() took 0.67008900642395 second(s)
JWT::encode() and JWT::decode() took 1.0262598991394 second(s)
The implementation is 1.53 time(s) faster than firebase
```

## Sponsor
It takes a lot of time to create and maintain a project.  If you think it helped you, could you buy me a cup of coffee? 😉  
You can use any of the following methods to donate:

| [![PayPal](/doc/img/paypal.svg)](https://www.paypal.com/paypalme/tianchentang)<br/>Click [here](https://www.paypal.com/paypalme/tianchentang) to donate | ![Wechat Pay](/doc/img/wechat.jpg)<br/>Wechat Pay | ![Alipay](/doc/img/alipay.jpg) Alipay |
|---------------------------------------------------------------------------------------------------------------------------------------------------------|---------------------------------------------------|---------------------------------------|
