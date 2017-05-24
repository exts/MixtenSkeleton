<?php

use Psr\Container\ContainerInterface;
use App\Core\Renderer\TwigRenderer;
use App\Core\Renderer\TwigRenderInterface;

//setup environment
$container->share(Twig_Environment::class, function(ContainerInterface $c) {
    $loader = new Twig_Loader_Filesystem($c['twig.dirs']);
    $twig = new Twig_Environment($loader, $c['twig.options']);
    return $twig;
});

//create alias
$container->alias(TwigRenderInterface::class, TwigRenderer::class);