<?php

declare(strict_types=1);

/*
 * This file is part of the package.
 *
 * (c) Nikolay Nikolaev <evrinoma@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Evrinoma\PhoneBundle;

use Evrinoma\PhoneBundle\DependencyInjection\Compiler\Constraint\Property\PhonePass;
use Evrinoma\PhoneBundle\DependencyInjection\Compiler\DecoratorPass;
use Evrinoma\PhoneBundle\DependencyInjection\Compiler\MapEntityPass;
use Evrinoma\PhoneBundle\DependencyInjection\Compiler\ServicePass;
use Evrinoma\PhoneBundle\DependencyInjection\EvrinomaPhoneExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class EvrinomaPhoneBundle extends Bundle
{
    public const BUNDLE = 'phone';

    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container
            ->addCompilerPass(new MapEntityPass($this->getNamespace(), $this->getPath()))
            ->addCompilerPass(new DecoratorPass())
            ->addCompilerPass(new ServicePass())
            ->addCompilerPass(new PhonePass())
        ;
    }

    public function getContainerExtension()
    {
        if (null === $this->extension) {
            $this->extension = new EvrinomaPhoneExtension();
        }

        return $this->extension;
    }
}
