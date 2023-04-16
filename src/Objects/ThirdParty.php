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

namespace Splash\Connectors\SymfonyUser\Objects;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Security\Core\User\UserInterface;
use Splash\Bundle\Models\AbstractStandaloneObject;
use Splash\Models\Objects\GenericFieldsTrait;
use Splash\Models\Objects\IntelParserTrait;
use Splash\Models\Objects\ListsTrait;
use Splash\Models\Objects\PrimaryKeysAwareInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

/**
 * Splash Object for FOS User Entities
 */
class ThirdParty extends AbstractStandaloneObject implements PrimaryKeysAwareInterface
{
    //====================================================================//
    // Splash Php Core Traits
    use IntelParserTrait;
    use GenericFieldsTrait;
    use ListsTrait;

    //====================================================================//
    // FOS USER Traits
    use ThirdParty\CrudTrait;
    use ThirdParty\CoreTrait;
    use ThirdParty\PrimaryTrait;
    use ThirdParty\ObjectListTrait;

    //====================================================================//
    // Object Definition Parameters
    //====================================================================//

    /**
     * {@inheritdoc}
     */
    protected static string $name = 'Symfony User';

    /**
     * {@inheritdoc}
     */
    protected static string $description = 'Symfony User Object';

    /**
     * {@inheritdoc}
     */
    protected static string $ico = 'fa fa-user';

    //====================================================================//
    // Object Synchronization Recommended Configuration
    //====================================================================//

    /**
     * {@inheritdoc}
     */
    protected static bool $enablePushCreated = false;

    //====================================================================//
    // Private variables
    //====================================================================//

    /**
     * @phpstan-var  UserInterface
     */
    protected object $object;

    /**
     * User Provider
     *
     * @var UserProviderInterface
     */
    protected UserProviderInterface $provider;

    /**
     * Entity Manager
     *
     * @var EntityManagerInterface
     */
    protected EntityManagerInterface $manager;

    /**
     * Users Repository
     *
     * @var EntityRepository
     */
    protected EntityRepository $repository;

    //====================================================================//
    // Service Constructor
    //====================================================================//

    /**
     * Splash Object Service Constructor
     *
     * @param class-string $userClass
     * @param UserProviderInterface $provider
     * @param EntityManagerInterface $objectManager
     */
    public function __construct(string $userClass, UserProviderInterface $provider, EntityManagerInterface $objectManager)
    {
        $this->manager = $objectManager;
        $this->repository = $objectManager->getRepository($userClass);
    }
}
