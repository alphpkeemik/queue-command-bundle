<?php declare(strict_types=1);

/*
 * This file is part of the Ambientia QueueCommand Bundle package.
 *
 * (c) Ambientia Estonia OÜ
 */

namespace Ambientia\QueueCommandBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

/**
 * @author mati.andreas@ambientia.ee
 */
class AmbientiaQueueCommandExtension extends Extension implements PrependExtensionInterface
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = $this->createLoader($container);
        $loader->load('services.yaml');
    }

    public function prepend(ContainerBuilder $container)
    {
        $bundles = $container->getParameter('kernel.bundles');

        if (isset($bundles['DoctrineBundle'])) {

            $loader = $this->createLoader($container);
            $loader->load('doctrine.yaml');
        }
    }

    private function createLoader(ContainerBuilder $container): YamlFileLoader
    {
        $loader = new YamlFileLoader(
            $container,
            new FileLocator(__DIR__ . '/../Resources/config')
        );

        return $loader;
    }
}