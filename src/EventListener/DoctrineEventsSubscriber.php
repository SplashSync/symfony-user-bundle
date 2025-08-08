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

namespace Splash\Connectors\SymfonyUser\EventListener;

use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Splash\Bundle\Helpers\Doctrine\AbstractEntityListener;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Splash Symfony User Doctrine Events Subscriber
 */
#[AsEntityListener(entity: UserInterface::class)]
class DoctrineEventsSubscriber extends AbstractEntityListener
{
    /**
     * {@inheritdoc}
     */
    protected static function getClassMap(): array
    {
        return array(
            UserInterface::class => "ThirdParty",
        );
    }
}
