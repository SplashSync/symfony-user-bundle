<?php

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
    Sonata\BlockBundle\SonataBlockBundle::class => ['all' => true],
    Sonata\Form\Bridge\Symfony\SonataFormBundle::class => ['all' => true],
    Sonata\Twig\Bridge\Symfony\SonataTwigBundle::class => ['all' => true],

    //==============================================================================
    // VARIOUS BUNDLES
    Knp\Bundle\MenuBundle\KnpMenuBundle::class => ['all' => true],

    //==============================================================================
    // SPLASH BUNDLES
    Splash\Bundle\SplashBundle::class => ['all' => true],
    Splash\Console\ConsoleBundle::class => ['all' => true],
    Splash\Connectors\SymfonyUser\SplashSymfonyUserBundle::class => ['all' => true],
    Splash\Connectors\SymfonyUser\Tests\SplashSymfonyUserTestsBundle::class => ['all' => true],
);