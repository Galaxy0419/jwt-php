<?php
/**
 * Benchmark with firebase jwt implementation
 *
 * PHP version 8
 *
 * @category Authentication
 * @author   Tianchen Tang <galaxyking0419@gmail.com>
 * @license  https://www.gnu.org/licenses/gpl-3.0.en.html GPLv3
 * @link     https://github.com/Galaxy0419/jwt-php
 */

require_once '../jwt.php';
require_once 'firebase-jwt.php';
require_once 'firebase-jwt-key.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

const NUMBER_OF_TOKENS = 100000;

/* Generate random payloads */
$payloads = [];
for ($i = 0; $i < NUMBER_OF_TOKENS; $i++) {
    $payload = [];
    $payload['string'] = base64_encode(random_bytes(21));
    $payload['number'] = random_int(PHP_INT_MIN, PHP_INT_MAX);
    $payload['bool'] = random_int(0, 1) === 0;
    $payloads[] = $payload;
}

$start = microtime(true);
for ($i = 0; $i < NUMBER_OF_TOKENS; $i++) {
    jwt_decode(jwt_encode($payloads[$i], $payloads[$i]['string']), $payloads[$i]['string']);
}
$time = microtime(true) - $start;
echo "jwt_encode() and jwt_decode() took $time second(s)" . PHP_EOL;

$start = microtime(true);
for ($i = 0; $i < NUMBER_OF_TOKENS; $i++) {
    JWT::decode(JWT::encode($payloads[$i], $payloads[$i]['string'], 'HS256'), new Key($payloads[$i]['string'], 'HS256'));
}
$firebase_time = microtime(true) - $start;
echo "JWT::encode() and JWT::decode() took $firebase_time second(s)" . PHP_EOL;

echo 'The implementation is ' . round($firebase_time / $time, 2) . ' time(s) faster than firebase' . PHP_EOL;
