<?php

/**
 * @file
 * Contains \Drupal\Tests\patternlab\Unit\MustacheTest
 *
 * @todo Work in Progress
 */

namespace Drupal\tests\patternlab\Unit;

use Drupal\Tests\UnitTestCase;
use Drupal\patternlab\Twig\MustacheExtension;
use Drupal\Core\Config\ImmutableConfig;
use Drupal\Core\Config\ConfigFactory;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Tests that we can integrate Mustache templates from a remote Patternlab instance.
 *
 * @group patternlab
 */
class MustacheTest extends UnitTestCase
{
    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();

        $config = $this->getMockBuilder(ImmutableConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $config->expects($this->any())
            ->method('get')
            ->will($this->returnValueMap([
                ['base_url', __DIR__ . '/../../mustache'],
                ['cache_dir', __DIR__ . '/../../cache']
            ]));

        $configFactory = $this->getMockBuilder(ConfigFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $configFactory->expects($this->any())
            ->method('get')
            ->with('chefkoch.patternlab')
            ->willReturn($config);

        $container = new ContainerBuilder();
        $container->set('config.factory', $configFactory);

        \Drupal::setContainer($container);
    }

    /**
     * Tests Mustache integration.
     * @see core/tests/Drupal/Tests/Core/Template/TwigExtensionTest.php
     */
    public function testMustacheIntegration()
    {
        $extension = new MustacheExtension();

        $loader = new \Twig_Loader_String();
        $twig = new \Twig_Environment($loader);
        $twig->addExtension($extension);

        $result = $twig->render('{{ component("hello", {name: "Olav"}) }}');
        $this->assertEquals('Hallo Olav!', $result);
    }

}
