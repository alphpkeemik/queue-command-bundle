<?php declare(strict_types=1);

/*
 * This file is part of the Ambientia QueueCommand Bundle package.
 */

namespace Ambientia\QueueCommandBundle\Tests\DependencyInjection;

use Ambientia\QueueCommand\CrashedProcessor;
use Ambientia\QueueCommand\CriteriaBuilder;
use Ambientia\QueueCommand\ExecuteCommand;
use Ambientia\QueueCommand\FlockStoreCleaner;
use Ambientia\QueueCommand\HashGenerator;
use Ambientia\QueueCommand\QueueCommand;
use Ambientia\QueueCommand\QueueCommandCommand;
use Ambientia\QueueCommand\QueueProcessor;
use Ambientia\QueueCommand\QueueRepository;
use Ambientia\QueueCommand\Repository;
use Doctrine\Persistence\ManagerRegistry;
use Matthias\SymfonyDependencyInjectionTest\PhpUnit\AbstractContainerBuilderTestCase;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\Reference;

/**
 * @author mati.andreas@ambientia.ee
 */
class ExtensionServicesTest extends AbstractContainerBuilderTestCase
{


    private function loadConfiguration(): void
    {
        $loader = new YamlFileLoader($this->container, new FileLocator(__DIR__ . '/../../Resources/config'));
        $loader->load('services.yaml');
    }


    public function testServiceCommand(): void
    {
        $this->loadConfiguration();


        $this->assertContainerBuilderHasService(
            QueueProcessor::class,
            null
        );
        $this->assertContainerBuilderHasServiceDefinitionWithArgument(
            QueueProcessor::class,
            0,
            new Reference(QueueRepository::class)
        );


        $this->assertContainerBuilderHasService(
            ExecuteCommand::class,
            null
        );


        $this->assertContainerBuilderHasServiceDefinitionWithMethodCall(
            ExecuteCommand::class,
            'setCrashedProcessor',
            [
                new Reference(CrashedProcessor::class)
            ]
        );

        $this->assertContainerBuilderHasServiceDefinitionWithMethodCall(
            ExecuteCommand::class,
            'setFlockStoreCleaner',
            [
                new Reference(FlockStoreCleaner::class)
            ]
        );

        $this->assertContainerBuilderHasServiceDefinitionWithMethodCall(
            ExecuteCommand::class,
            'setQueueProcessor',
            [
                new Reference(QueueProcessor::class)
            ]
        );


        $this->assertContainerBuilderHasServiceDefinitionWithMethodCall(
            ExecuteCommand::class,
            'setCriteriaBuilder',
            [
                new Reference(CriteriaBuilder::class)
            ]
        );

        $this->assertContainerBuilderHasServiceDefinitionWithTag(
            ExecuteCommand::class,
            'console.command'
        );


        $this->assertContainerBuilderHasService(
            Repository::class,
            null
        );

        $this->assertContainerBuilderHasService(
            HashGenerator::class,
            null
        );


        $this->assertContainerBuilderHasServiceDefinitionWithArgument(
            Repository::class,
            0,
            new Reference(ManagerRegistry::class)

        );

        $this->assertContainerBuilderHasServiceDefinitionWithArgument(
            Repository::class,
            1,
            new Reference(HashGenerator::class)

        );

        $this->assertContainerBuilderHasService(
            QueueRepository::class,
            null
        );



        $this->assertContainerBuilderHasServiceDefinitionWithArgument(
            QueueRepository::class,
            0,
            new Reference(ManagerRegistry::class)

        );

    }

}
