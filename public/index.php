<?php
ini_set("display_errors", 1);

use Mixten\Application;

(function() {
    try {
        /** @var Application $app */
        $app = require_once __DIR__ . '/../bootstrap.php';
        $app->run();
    } catch(\Exception $e) {
        echo $e->getMessage();
    }
})();