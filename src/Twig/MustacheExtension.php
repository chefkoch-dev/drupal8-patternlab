<?php

namespace Drupal\patternlab\Twig;

use Mustache_Loader_FilesystemLoader;

class MustacheExtension extends \Twig_Extension
{
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('component',
                function ($templatePath, $arguments)
                {
                    //$templateBaseUrl = \Drupal::config('chefkoch.patternlab')->get('base_url');
                    $templateBaseUrl = __DIR__ . '/../../../mustache';

                    $mustache = new \Mustache_Engine([
                        'cache' => DRUPAL_ROOT . '/sites/default/files/mustache',
                        'loader' => new Mustache_Loader_FilesystemLoader($templateBaseUrl),
                    ]);

                    $template = $mustache->loadTemplate($templatePath);
                    return $template->render($arguments);
                },
                [
                    'is_safe' => ['html']
                ]
            )
        ];
    }

    public function getName()
    {
        return 'mustache';
    }
}
