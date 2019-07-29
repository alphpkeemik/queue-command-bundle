<?php declare(strict_types=1);

/*
 * This file is part of the Ambientia QueueCommand Bundle package.
 *
 * (c) Ambientia Estonia OÜ
 */

namespace Ambientia\QueueCommandBundle\Tests\DependencyInjection;

use Ambientia\QueueCommand\ObjectNormalizer;
use Ambientia\QueueCommandBundle\DependencyInjection\CompilerPass;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * @author mati.andreas@ambientia.ee
 */
class CompilerPassTest extends TestCase
{
    public function testParameter(): void
    {
        $container = $this->createMock(ContainerBuilder::class);

        $container
            ->expects($this->once())
            ->method('setParameter')
            ->with(
                    'ambientia.queue_command.flock_dir',
                    '%kernel.project_dir%/var/queue-command-lock'
            );


        $compilerPass = new CompilerPass();
        $compilerPass->process($container);
    }
}