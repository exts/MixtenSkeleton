<?php
namespace App\Core\Renderer;

/**
 * Class TwigRenderer
 *
 * @package TMI\Core\Renderer
 */
class TwigRenderer implements TwigRenderInterface
{
    /**
     * @var \Twig_Environment
     */
    private $twig;

    /**
     * TwigRenderer constructor.
     *
     * @param \Twig_Environment $twig
     */
    public function __construct(\Twig_Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @param $template
     * @param array $options
     *
     * @return string
     */
    public function render($template, array $options = [])
    {
        return $this->twig->render($template, $options);
    }
}