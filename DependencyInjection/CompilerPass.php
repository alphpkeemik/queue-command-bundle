<?php declare(strict_types=1);

/*
 * This file is part of the Ambientia QueueCommand Bundle package.
 *
 * (c) Ambientia Estonia OÜ
 */

namespace Ambientia\QueueCommandBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class CompilerPass implements CompilerPassInterface
{

    public function process(ContainerBuilder $container)
    {
        $container->setParameter(
            'ambientia.queue_command.flock_dir',
            '%kernel.project_dir%/var/queue-command-lock'
        );
    }
}
