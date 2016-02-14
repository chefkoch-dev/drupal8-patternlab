<?php

namespace Drupal\patternlab\Twig;

use Mustache_Loader_FilesystemLoader;

class MustacheExtension extends \Twig_Extension
{
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('component',
                function ($templatePath, $arguments = [])
                {
                    $config = \Drupal::config('chefkoch.patternlab');
                    $templateBaseUrl = $config->get('base_url');
                    $mustacheCacheDir = $config->get('cache_dir');

                    $mustache = new \Mustache_Engine([
                        'pragmas' => [\Mustache_Engine::PRAGMA_BLOCKS],
                        'cache' => $mustacheCacheDir,
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
