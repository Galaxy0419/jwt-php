<?php
/**
 * A simple, fast HS256 JWT(JSON Web Token) implementation in PHP
 *
 * PHP version 8
 *
 * @category Authentication
 * @author   Tianchen Tang <galaxyking0419@gmail.com>
 * @license  https://www.gnu.org/licenses/gpl-3.0.en.html GPLv3
 * @link     https://github.com/Galaxy0419/jwt-php
 */

const HS256_HEADER = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9';

/**
 * Encode payload using HS256 signature
 *
 * @param array|string $payload The JWT payload
 * @param string $key The HS256 key
 * @return string Decoded payload
 */
function jwt_encode(array|string $payload, string $key): string
{
    if (is_array($payload))
        $payload = json_encode($payload);

    $jwt = HS256_HEADER . '.' . strtr(rtrim(base64_encode($payload), '='), '+/', '-_');
    return $jwt . '.' . strtr(rtrim(base64_encode(hash_hmac('sha256', $jwt, $key, true)), '='), '+/', '-_');
}

/**
 * Decoded payload if it is verified by HS256 signature
 * Warning: JWT claims are not validated by this method
 *
 * @param string $jwt The JWT token
 * @param string $key The HS256 key
 * @return object|null Decoded payload object, or null if payload cannot be decoded as JSON
 *
 * @throws UnexpectedValueException If the signature does not match
 */
function jwt_decode(string $jwt, string $key): object|null
{
    $segments = explode('.', $jwt);
    $signature = strtr(rtrim(base64_encode(hash_hmac('sha256',
        $segments[0] . '.' . $segments[1], $key, true)), '='), '+/', '-_');

    if ($signature === $segments[2])
        return json_decode(base64_decode(strtr($segments[1], '-_', '+/')));
    else
        throw new UnexpectedValueException("Invalid HS256 signature!", 1);
}
