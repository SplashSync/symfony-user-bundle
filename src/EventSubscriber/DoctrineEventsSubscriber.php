<?php

/*
 *  This file is part of SplashSync Project.
 *
 *  Copyright (C) 2015-2021 Splash Sync  <www.splashsync.com>
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace Splash\Connectors\FosUser\EventSubscriber;

use FOS\UserBundle\Model\UserInterface;
use Splash\Bundle\Helpers\Doctrine\AbstractEventSubscriber;

/**
 * Splash Fos User Doctrine Events Subscriber
 */
class DoctrineEventsSubscriber extends AbstractEventSubscriber
{
    /**
     * {@inheritdoc}
     */
    protected static $classMap = array(
        UserInterface::class => "ThirdParty",
    );

    /**
     * {@inheritdoc}
     */
    protected static $username = "Symfony";

    /**
     * {@inheritdoc}
     */
    protected static $commentPrefix = "FOS User";
//
//    //====================================================================//
//    //  CONSTRUCTOR
//    //====================================================================//
//
//    /**
//     * Service Constructor
//     *
//     * @param ConnectorsManager $manager
//     */
//    public function __construct(ConnectorsManager $manager)
//    {
//        parent::__construct($manager);
//        // Use Kernel Events for Update, better Compatibility
//        static::setState(Events::postUpdate, false);
//    }
//
//    /**
//     * On Akeneo Pre Load Fixtures
//     */
//    public function preLoadFixtures(): void
//    {
//        static::setState(Events::postPersist, false);
//        static::setState(Events::postUpdate, false);
//    }
}
