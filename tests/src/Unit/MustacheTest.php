<?php

/**
 * @file
 * Contains \Drupal\Tests\patternlab\Unit\MustacheTest
 *
 * @todo Work in Progress
 */

namespace Drupal\tests\patternlab\Unit;

use Drupal\Tests\UnitTestCase;

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
        /** @var \Drupal\Core\Template\TwigEnvironment $twig */
        $twig = \Drupal::service('twig');

        $this->assertEquals('Hallo Olav!',
            $twig->render('{{ component("hello", {name: "Olav"}) }}')
        );
    }
}
