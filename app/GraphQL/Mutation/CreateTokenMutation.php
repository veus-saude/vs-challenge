<?php
namespace App\GraphQL\Mutation;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Log;

class CreateTokenMutation extends Mutation
{
    protected $attributes = [
        'name' => 'createToken',
        'description' => 'Create a token for user'
    ];

    public function type()
    {
        return GraphQL::type('token');
    }

    public function args()
    {
        return [
            'login' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'User Login',
            ],
            'password'=> [
                'type' => Type::nonNull(Type::string()),
                'description' => 'User Password',
            ],
        ];
    }

    /**
     * @SuppressWarnings("unused")
     */
    public function resolve($root, $args)
    {
        $token = '';
        $credentials = [
            'email' => isset($args['login']) ? $args['login'] : null,
            'password' => isset($args['password']) ? $args['password'] : null
        ];

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                abort(401, 'Invalid login or password.');
            }
        } catch (JWTException $e) {
            Log::info("Failed to create jwt token for login: {$credentials['login']}. {$e->getMessage()}.");
            abort(500, 'Could not create token.');
        }

        return ['token' => $token];
    }
}
