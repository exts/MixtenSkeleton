<?php

use Canister\Canister;
use Mixten\Application;

require_once "vendor/autoload.php";

/**
 * Load global config settings
 */

$config = include __DIR__ . '/config/config.php';

/**
 * Setup Container
 */

$container = new Canister($config);

/**
 * Forms
 */

include_once __DIR__ . '/forms.php';

/**
 * Setup Translator
 */

include_once __DIR__ . '/translations.php';

/**
 * Setup Twig
 */

include_once __DIR__ . '/twig.php';

/**
 * Setup Database
 */

include_once __DIR__ . '/database.php';

/**
 * Setup Application
 */

$app = new Application($container);

/**
 * Handle Routes
 */

include_once __DIR__ . '/routes.php';

/**
 * Return Application
 */
return $app;