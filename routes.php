<?php

use App\User\Controllers\RegisterController;
use function Mixten\cc;

$app->any('/register', cc(RegisterController::class, 'register'));