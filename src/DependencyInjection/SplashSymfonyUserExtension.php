<?php

/*
 *  This file is part of SplashSync Project.
 *
 *  Copyright (C) Splash Sync  <www.splashsync.com>
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace Splash\Connectors\SymfonyUser\DependencyInjection;

use Exception;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class SplashSymfonyUserExtension extends Extension
{
    /**
     * {@inheritdoc}
     *
     * @throws Exception
     */
    public function load(array $configs, ContainerBuilder $container): void
    {
        //====================================================================//
        // Load Bundle Configuration
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);
        //====================================================================//
        // Register Bundle Services
        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yaml');
        //====================================================================//
        // Load List of Available Bundles
        $bundles = $container->getParameter('kernel.bundles');
        \assert(\is_array($bundles));
        //====================================================================//
        // Register Sonata User Extension
        if (isset($bundles['SonataUserBundle'])) {
            $loader->load('sonata.yaml');
        }

        $container->setParameter('splash.symfony.user.class', $config['class']['user'] ?? null);
    }
}
