<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use App\Http\Payload;
use App\Http\Controllers\services\UserController;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {

        return route('login');
    }

    // $userController = new UserController();
    // $payload = $userController->getgetUserByUserNameAndPassword($request);
    // if($payload == null){
    //     return route('login');
    // }

    // return $next($request);

}
