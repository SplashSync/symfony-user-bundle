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

namespace Splash\Connectors\SymfonyUser\Objects\ThirdParty;

use Symfony\Component\Security\Core\User\UserInterface;
use Splash\Client\Splash;

/**
 * Symfony User CRUD
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
     * @return null|UserInterface
     */
    public function load(string $objectId): ?UserInterface
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
        if (!$user instanceof UserInterface) {
            return Splash::log()->errNull(
                ' Unable to load '.$this->getName().' ('.$objectId.').'
            );
        }

        return $user;
    }

    /**
     * Create Request Object
     *
     * @return null|UserInterface
     */
    public function create(): ?UserInterface
    {
        //====================================================================//
        // Stack Trace
        Splash::log()->trace();
        //====================================================================//
        // Collect Required Fields
        /** @var null|string $userName */
        $userName = $this->in["username"] ?? null;
        /** @var null|string $userEmail */
        $userEmail = $this->in["email"] ?? null;
        if (empty($userName) || empty($userEmail)) {
            return Splash::log()->errNull(
                "ErrLocalFieldMissing",
                __CLASS__,
                __FUNCTION__,
                "User Name or Email"
            );
        }
        //====================================================================//
        // Safety Check
        $className = $this->repository->getClassName();
        if (!$className || !class_exists($className)) {
            return null;
        }
        //====================================================================//
        // Create New User Entity
        $this->object = new $className();
        $this->object->setUsername($userName);
        $this->object->setEmail($userEmail);
        $this->object->setPlainPassword(uniqid());
        //====================================================================//
        // Save New User Entity
        if (!$this->update(true)) {
            return null;
        }

        return $this->object;
    }

    /**
     * Update Request Object
     *
     * @param bool $needed Is This Update Needed
     *
     * @return null|string Object ID
     */
    public function update(bool $needed): ?string
    {
        //====================================================================//
        // Save
        if ($needed) {
            try {
                $this->manager->persist($this->object);
                $this->manager->flush();
            } catch (\Throwable $throwable) {
                return Splash::log()->errNull($throwable->getMessage());
            }
        }

        return $this->getObjectIdentifier();
    }

    /**
     * {@inheritdoc}
     */
    public function delete(string $objectId): bool
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
            $this->manager->remove($user);
            $this->manager->flush();
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function getObjectIdentifier(): ?string
    {
        if (empty($this->object->getId())) {
            return null;
        }
        /** @phpstan-ignore-next-line  */
        return (string) $this->object->getId();
    }
}
