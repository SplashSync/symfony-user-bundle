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

namespace Splash\Connectors\SymfonyUser\EventSubscriber;

use Symfony\Component\Security\Core\User\UserInterface;
use Splash\Bundle\Helpers\Doctrine\AbstractEventSubscriber;

/**
 * Splash Symfony User Doctrine Events Subscriber
 */
class DoctrineEventsSubscriber extends AbstractEventSubscriber
{
    /**
     * {@inheritdoc}
     */
    protected static array $classMap = array(
        UserInterface::class => "ThirdParty",
    );

    /**
     * {@inheritdoc}
     */
    protected static string $username = "Symfony";

    /**
     * {@inheritdoc}
     */
    protected static string $commentPrefix = "Symfony User";
}
