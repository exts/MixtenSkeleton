<?php

use function Mixten\cc;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Bridge\PsrHttpMessage\Factory\HttpFoundationFactory;

/**
 * Shortcut for cc(Class::class, 'process') which is used for class actions
 * in action based applications
 *
 * @param string $action
 *
 * @return string
 */
function act(string $action)
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

/**
 * @param ServerRequestInterface $request
 *
 * @return \Symfony\Component\HttpFoundation\Request
 */
function symfonyRequest(ServerRequestInterface $request)
{
    return (new HttpFoundationFactory()) -> createRequest($request);
}

/**
 * @param ResponseInterface $response
 *
 * @return \Symfony\Component\HttpFoundation\Response
 */
function symfonyResponse(ResponseInterface $response)
{
    return (new HttpFoundationFactory()) -> createResponse($response);
}
