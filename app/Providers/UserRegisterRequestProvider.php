<?php

namespace App\Providers;

use app\Http\Requests\UserRegisterRequest;
use Illuminate\Support\ServiceProvider;

class UserRegisterRequestServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->resolving(UserRegisterRequest::class, function ($request, $app) {
            UserRegisterRequest::createFrom($app['request'], $request);
        });
    }
}
