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

use Doctrine\Bundle\DoctrineBundle\Attribute\AsDoctrineListener;
use Doctrine\ORM\Events;
use Splash\Bundle\Helpers\Doctrine\AbstractEntityListener;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Splash Symfony User Doctrine Events Subscriber
 */
#[AsDoctrineListener(event: Events::postPersist)]
#[AsDoctrineListener(event: Events::postUpdate)]
#[AsDoctrineListener(event: Events::preRemove)]
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

    /**
     * On Entity Created Doctrine Event
     */
    public function postPersist(object $subject): void
    {
        if (!$subject instanceof UserInterface) {
            return;
        }
        parent::postPersist($subject);
    }

    /**
     * On Entity Updated Doctrine Event
     */
    public function postUpdate(object $subject): void
    {
        if (!$subject instanceof UserInterface) {
            return;
        }
        parent::postUpdate($subject);
    }

    /**
     * On Entity Before Deleted Doctrine Event
     */
    public function preRemove(object $subject): void
    {
        if (!$subject instanceof UserInterface) {
            return;
        }
        parent::preRemove($subject);
    }
}
