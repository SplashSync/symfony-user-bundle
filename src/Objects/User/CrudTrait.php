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

namespace Splash\Connectors\FosUser\Objects\User;

use FOS\UserBundle\Model\UserInterface;
use Splash\Client\Splash;

/**
 * FOS User CRUD
 */
trait CrudTrait
{
    //====================================================================//
    // Generic Objects CRUD Functions
    //====================================================================//

    /**
     * Load Request Object
     *
     * @param string $objectId Object id
     *
     * @return false|UserInterface
     */
    public function load($objectId)
    {
        //====================================================================//
        // Stack Trace
        Splash::log()->trace();
        //====================================================================//
        // Search in Repository
        /** @var null|UserInterface $user */
        $user = $this->repository->findOneBy(array(
            'id' => $objectId,
        ));
        //====================================================================//
        // Check Object Entity was Found
        if (!$user) {
            return Splash::log()->errTrace(
                ' Unable to load '.$this->getName().' ('.$objectId.').'
            );
        }

        return $user;
    }

    /**
     * Create Request Object
     *
     * @return false|UserInterface
     */
    public function create()
    {
        //====================================================================//
        // Stack Trace
        Splash::log()->trace();
        //====================================================================//
        // Create New User Entity
        $this->object = $this->manager->createUser();
        $this->object->setUsername($this->in["username"]);
        $this->object->setEmail($this->in["email"]);
        $this->object->setPlainPassword(uniqid());
        //====================================================================//
        // Save New User Entity
        if (!$this->update(true)) {
            return false;
        }

        return $this->object;
    }

    /**
     * Update Request Object
     *
     * @param bool $needed Is This Update Needed
     *
     * @return false|string Object Id
     */
    public function update($needed)
    {
        //====================================================================//
        // Save
        if ($needed) {
            try {
                $this->manager->updateUser($this->object);
            } catch (\Throwable $throwable) {
                return Splash::log()->err($throwable->getMessage());
            }
        }

        return $this->getObjectIdentifier();
    }

    /**
     * @param null|string $objectId
     *
     * @return bool
     */
    public function delete($objectId = null)
    {
        //====================================================================//
        // Safety Check
        if (null == $objectId) {
            return true;
        }
        //====================================================================//
        // Try Loading Object to Check if Exists
        $user = $this->load($objectId);
        if ($user) {
            //====================================================================//
            // Delete
            $this->manager->deleteUser($user);
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function getObjectIdentifier()
    {
        if (empty($this->object->getId())) {
            return false;
        }

        return (string) $this->object->getId();
    }
}
