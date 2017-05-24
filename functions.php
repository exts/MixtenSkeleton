<?php

use function Mixten\cc;

/**
 * Shortcut for cc(Class::class, 'process') which is used for class actions
 * in action based applications
 *
 * @param string $action
 *
 * @return string
 */
function _a(string $action)
{
    return cc($action, 'process');
}

/**
 * Return root path
 *
 * @param $path
 * @param string|null $directory (optional)
 *
 * @return string
 */
function root(string $path = null, string $directory = null)
{
    $directory = $directory ?? __DIR__;
    return isset($path) ? $directory . '/' . ltrim($path, '/') : $directory;
}