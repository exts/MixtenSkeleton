<?php

use Zend\ConfigAggregator\ConfigAggregator;
use Zend\ConfigAggregator\PhpFileProvider;

/**
 * Nifty trick to change the directory without messing with
 * any other code since glob() works weirdly and bases itself
 * off the current folder of the file that's calling the function.
 */
return (function() {

    //change directory to the config file
    chdir(root('config'));

    $aggregator = new ConfigAggregator([
        new PhpFileProvider('autoload/{,*.}global.php'),
    ], root('data/cache-config.php'));

    return $aggregator->getMergedConfig();
})();