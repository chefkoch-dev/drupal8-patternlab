<?php

namespace Drupal\patternlab\Twig;

class MustacheExtension extends \Twig_Extension
{
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('component',
                function ($templateUrl, $arguments)
                {
                    $template = file_get_contents($templateUrl);
                    $m = new \Mustache_Engine;
                    return $m->render($template, $arguments);
                }
            )
        ];
    }

    public function getName()
    {
        return 'mustache';
    }
}
