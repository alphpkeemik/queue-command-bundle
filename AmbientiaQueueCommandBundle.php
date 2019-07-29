<?php declare(strict_types=1);

/*
 * This file is part of the Ambientia QueueCommand Bundle package.
 *
 * (c) Ambientia Estonia OÜ
 */

namespace Ambientia\QueueCommandBundle;

use Ambientia\QueueCommand\QueryProviderInterface;
use Ambientia\QueueCommandBundle\DependencyInjection\CompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * @author mati.andreas@ambientia.ee
 */
class AmbientiaQueueCommandBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new CompilerPass());
    }

}