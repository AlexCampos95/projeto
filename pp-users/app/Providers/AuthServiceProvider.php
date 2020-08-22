<?php

namespace App\Providers;

use Firebase\JWT\JWT;
use Illuminate\Auth\GenericUser;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        // Here you may define how you wish users to be authenticated for your Lumen
        // application. The callback which receives the incoming request instance
        // should return either a Users instance or null. You're free to obtain
        // the Users instance via an API token or any other method necessary.

        $this->app['auth']->viaRequest('api', function ($request) {
            if (!$request->hasHeader('token')) {
                return null;
            }

            $authorizationHeader = $request->header('token');
            $token = str_replace('Bearer', '', $authorizationHeader);
            $dadosAutenticacao = JWT::decode($token, env('JWT_KEY'), ['HS256']);
            return new GenericUser([
                'id' => $dadosAutenticacao->userId,
                'user_types_id' => $dadosAutenticacao->userTypesId
            ]);
        });
    }
}
