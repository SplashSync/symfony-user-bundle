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

namespace Splash\Connectors\FosUser\Objects;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;
use FOS\UserBundle\Model\UserInterface;
use FOS\UserBundle\Model\UserManagerInterface;
use Splash\Bundle\Models\AbstractStandaloneObject;
use Splash\Models\Objects\GenericFieldsTrait;
use Splash\Models\Objects\IntelParserTrait;
use Splash\Models\Objects\ListsTrait;

class User extends AbstractStandaloneObject
{
    //====================================================================//
    // Splash Php Core Traits
    use IntelParserTrait;
    use GenericFieldsTrait;
    use ListsTrait;

    //====================================================================//
    // FOS USER Traits
    use User\CrudTrait;
    use User\CoreTrait;
    use User\SonataTrait;
    use User\SonataMetaTrait;
    use User\ObjectListTrait;

    //====================================================================//
    // Object Definition Parameters
    //====================================================================//

    /**
     * {@inheritdoc}
     */
    protected static $NAME = 'Symfony User';

    /**
     * {@inheritdoc}
     */
    protected static $DESCRIPTION = 'Sf User';

    /**
     * {@inheritdoc}
     */
    protected static $ICO = 'fa fa-user';

    //====================================================================//
    // Private variables
    //====================================================================//

    /**
     * @var UserInterface
     */
    protected $object;

    /**
     * FOS User Manager
     *
     * @var UserManagerInterface
     */
    protected $manager;

    /**
     * Users Repository
     *
     * @var ObjectRepository
     */
    protected $repository;

    //====================================================================//
    // Service Constructor
    //====================================================================//

    /**
     * Splash Object Service Constructor
     *
     * @param UserManagerInterface $manager
     * @param ObjectManager        $objectManager
     */
    public function __construct(UserManagerInterface $manager, ObjectManager $objectManager)
    {
        $this->manager = $manager;
        $this->repository = $objectManager->getRepository($manager->getClass());
    }
}
