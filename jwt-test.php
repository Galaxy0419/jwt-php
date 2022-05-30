<?php
/**
 * Test cases for HS256 JWT implementation
 *
 * PHP version 8
 *
 * @category Authentication
 * @author   Tianchen Tang <galaxyking0419@gmail.com>
 * @license  https://www.gnu.org/licenses/gpl-3.0.en.html GPLv3
 * @link     https://github.com/Galaxy0419/jwt-php
 */

require_once 'jwt.php';

const KEY = 'I love PHP!';
const BAD_KEY = 'I hate PHP!';
const PAYLOAD = '{"sub":"1234567890","name":"John Doe","iat":1516239022}';
const JWT = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkpvaG4gRG9lIiwiaWF0IjoxNTE2MjM5MDIyfQ.2w4I7hSwkG9sARW2S4RPv4fefvFa3RggeSwmXWmZC2k';

$decoded_payload = (object)[
    'sub' => '1234567890',
    'name' => 'John Doe',
    'iat' => 1516239022
];

$jwt = jwt_encode(PAYLOAD, KEY);
echo 'jwt_encode(): ' . ($jwt === JWT ? 'Passed' : 'Failed') . PHP_EOL;

echo 'jwt_decode(): ' . (jwt_decode(JWT, KEY) == $decoded_payload ? 'Passed' : 'Failed') . PHP_EOL;

try {
    jwt_decode(JWT, BAD_KEY);
    echo 'jwt_decode() with bad key: Failed' . PHP_EOL;
} catch (UnexpectedValueException $e) {
    echo 'jwt_decode() with bad key: Passed (' . $e->getMessage() . ')' . PHP_EOL;
}
