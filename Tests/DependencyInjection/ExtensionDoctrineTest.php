<?php declare(strict_types=1);

/*
 * This file is part of the Ambientia QueueCommand Bundle package.
 *
 * (c) Ambientia Estonia OÜ
 */

namespace Ambientia\QueueCommandBundle\Tests\DependencyInjection;

use Doctrine\Bundle\DoctrineBundle\DependencyInjection\Configuration;
use Doctrine\Bundle\DoctrineBundle\DependencyInjection\DoctrineExtension;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

/**
 * @author mati.andreas@ambientia.ee
 */
class ExtensionDoctrineTest extends TestCase
{

    public function testDoctrine(): void
    {
        $expected = [
            [
                'orm' => [
                    'mappings' => [
                        'AmbientiaQueueCommandBundle' => [
                            'is_bundle' => true,
                            'type' => 'xml',
                            'dir' => 'Resources/orm',
                            'prefix' => 'Ambientia\QueueCommand',
                            'alias' => 'Ambientia\QueueCommand',
                            'mapping' => true
                        ]
                    ]
                ]
            ]
        ];


        $container = new ContainerBuilder();
        $container->registerExtension(new DoctrineExtension());
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../../Resources/config'));
        $loader->load('doctrine.yaml');
        $processor = new Processor();
        $processor->process((new Configuration(false))->getConfigTreeBuilder()->buildTree(), []);

        $configs = $container->getExtensionConfig('doctrine');

        $this->assertSame($configs, $expected);

    }

}