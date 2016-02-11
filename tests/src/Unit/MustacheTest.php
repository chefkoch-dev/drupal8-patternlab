<?php

/**
 * @file
 * Contains \Drupal\Tests\patternlab\Unit\MustacheTest
 *
 * @todo Work in Progress
 */

namespace Drupal\tests\patternlab\Unit;

use Drupal\Tests\UnitTestCase;
use Drupal\Core\Test\TestRunnerKernel;
use Symfony\Component\HttpFoundation\Request;

/**
 * Tests that we can integrate Mustache templates from a remote Patternlab instance.
 *
 * @group patternlab
 */
class MustacheTest extends UnitTestCase
{
    /**
     * Tests Mustache integration.
     */
    public function testMustacheIntegration()
    {
        $drupalRoot = __DIR__ . '/../../../../../..';

        require_once $drupalRoot . '/core/includes/module.inc';
        $autoloader = require $drupalRoot . '/autoload.php';

        $request = Request::create('/');
        $kernel = TestRunnerKernel::createFromRequest($request, $autoloader);
        $kernel->setSitePath('sites/default');
        $kernel->boot();

        /** @var \Drupal\Core\Template\TwigEnvironment $twig */
        $twig = \Drupal::service('twig');

        $rendered = $twig->render('{{ component("hello", {name: "Olav"}) }}');
        $this->assertEquals('Hallo Olav!', $rendered);
    }
}
