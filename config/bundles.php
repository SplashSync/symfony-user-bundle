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

return array(
    //==============================================================================
    // SYMFONY STANDARD EDITION
    //==============================================================================
    Symfony\Bundle\FrameworkBundle\FrameworkBundle::class => array("all" => true),
    Symfony\Bundle\SecurityBundle\SecurityBundle::class => array("all" => true),
    Symfony\Bundle\TwigBundle\TwigBundle::class => array("all" => true),

    //==============================================================================
    // DEV & DEBUG BUNDLES
    Symfony\Bundle\DebugBundle\DebugBundle::class => array("dev" => true),
    Symfony\Bundle\WebProfilerBundle\WebProfilerBundle::class => array("dev" => true),

    //==============================================================================
    // DOCTRINE
    Doctrine\Bundle\DoctrineBundle\DoctrineBundle::class => array("all" => true),

    //==============================================================================
    // SONATA PROJECT
    Sonata\UserBundle\SonataUserBundle::class => array("all" => true),
    Sonata\Doctrine\Bridge\Symfony\SonataDoctrineBundle::class => array("all" => true),
    Sonata\AdminBundle\SonataAdminBundle::class => array("all" => true),
    Sonata\DoctrineORMAdminBundle\SonataDoctrineORMAdminBundle::class => array("all" => true),
    Sonata\BlockBundle\SonataBlockBundle::class => array('all' => true),
    Sonata\Form\Bridge\Symfony\SonataFormBundle::class => array('all' => true),
    Sonata\Twig\Bridge\Symfony\SonataTwigBundle::class => array('all' => true),

    //==============================================================================
    // VARIOUS BUNDLES
    Knp\Bundle\MenuBundle\KnpMenuBundle::class => array('all' => true),

    //==============================================================================
    // SPLASH BUNDLES
    Splash\Bundle\SplashBundle::class => array('all' => true),
    Splash\Console\ConsoleBundle::class => array('all' => true),
    Splash\Connectors\SymfonyUser\SplashSymfonyUserBundle::class => array('all' => true),
    Splash\Connectors\SymfonyUser\Tests\SplashSymfonyUserTestsBundle::class => array('all' => true),
);
