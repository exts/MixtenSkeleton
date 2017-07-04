<?php

use Psr\Container\ContainerInterface;
use Symfony\Bridge\Twig\Extension\TranslationExtension;
use Symfony\Bridge\Twig\Form\TwigRenderer as FormTwigRenderer;
use Symfony\Bridge\Twig\Extension\FormExtension;
use Symfony\Bridge\Twig\Form\TwigRendererEngine;
use Symfony\Component\Security\Csrf\CsrfTokenManager;
use Symfony\Component\Translation\Translator;

//setup environment
$container->share(Twig_Environment::class, function(ContainerInterface $c) {

    /* setup loader */
    $loader = new Twig_Loader_Filesystem();

    /* setup twig directories */
    $twig_dirs = $c['twig.dirs'] ?? [];
    $twig_dirs = is_array($twig_dirs) ? $twig_dirs : [];
    foreach($twig_dirs as $namespace => $dir) {
        if(is_int($namespace)) {
            $loader->addPath($dir);
        } else {
            $loader->addPath($dir, $namespace);
        }
    }

    /* setup symfony forms twig bridge */
    $app_var_reflection = new \ReflectionClass('\Symfony\Bridge\Twig\AppVariable');
    $vendor_twig_bridge_dir = dirname($app_var_reflection->getFileName());

    //add folder to path
    $loader->addPath($vendor_twig_bridge_dir . '/Resources/views/Form');

    /* setup twig */
    $twig = new Twig_Environment($loader, $c['twig.options']);

    $default_form_theme = 'form_div_layout.html.twig';
    $form_engine = new TwigRendererEngine([$default_form_theme], $twig);

    $csrf_token_manager = $c->get(CsrfTokenManager::class);
    $twig->addRuntimeLoader(new Twig_FactoryRuntimeLoader([
        FormTwigRenderer::class => function() use($form_engine, $csrf_token_manager) {
            return new \Symfony\Bridge\Twig\Form\TwigRenderer($form_engine, $csrf_token_manager);
        },
    ]));

    $twig->addExtension(new FormExtension());
    $twig->addExtension(new TranslationExtension($c->get(Translator::class)));

    return $twig;
});