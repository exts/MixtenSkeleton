<?php

use Symfony\Component\HttpFoundation\Session\Session;

//get application
$app = include_once __DIR__ . '/bootstrap.php';

//start session
$session = $container->get(Session::class);
$session->start();

return $app;