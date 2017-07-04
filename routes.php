<?php

use App\User\Controllers\AuthControllerLazy;
use App\User\Controllers\RegisterController;
use App\User\Controllers\RegisterControllerLazy;
use function Mixten\cc;


$app->any('/login', cc(AuthControllerLazy::class, 'login'));
$app->any('/logout', cc(AuthControllerLazy::class, 'logout'));
$app->any('/register', cc(RegisterController::class, 'register'));
$app->any('/register_lazy', cc(RegisterControllerLazy::class, 'register'));