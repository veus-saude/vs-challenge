<?php
namespace App\Helpers;

use App\Common\Authenticator;
use Illuminate\Http\Request;
use App\Exceptions\HeaderWithoutAuthorizationException;

/**
 * This class is used like a helper getting auth properties
 *
 * @since 1.0
 */
class ValidateAuthentication
{
    /**
     * Returns the data of token passed on Request
     * @since 1.0
     * @param Request $request
     * @return \stdClass
     * @throws HeaderWithoutAuthorizationException
     */
    public static function token(Request $request): \stdClass
    {
        $authorization = $request->headers->get('authorization');

        if (!isset($authorization)) {
            throw new HeaderWithoutAuthorizationException('The request does not contain the Authorization header');
        }

        $token = preg_replace('/^\w+\s/', '', $authorization);

        return Authenticator::decodeToken($token);
    }
}
