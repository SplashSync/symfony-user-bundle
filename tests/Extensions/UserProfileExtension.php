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

namespace Splash\Connectors\SymfonyUser\Tests\Extensions;

use Splash\Components\FieldsFactory;
use Splash\Connectors\SymfonyUser\Tests\Entity\User;
use Splash\Models\ObjectExtensionInterface;
use Splash\Models\Objects\GenericFieldsTrait;
use Splash\Models\Objects\UpdateFlagTrait;

/**
 * Use Splash Objects Extension to add custom Local fields to ThirdParty Objects
 */
class UserProfileExtension implements ObjectExtensionInterface
{
    use GenericFieldsTrait;
    use UpdateFlagTrait;

    /**
     * @var User
     */
    protected User $object;

    /**
     * @var array
     */
    protected array $out = array();

    /**
     * {@inheritDoc}
     */
    public function getExtendedTypes(): array
    {
        return array('ThirdParty');
    }

    /**
     * {@inheritDoc}
     */
    public function buildExtendedFields(string $objectType, FieldsFactory $factory): void
    {
        //====================================================================//
        // Firstname
        $factory->create(SPL_T_VARCHAR)
            ->identifier("firstname")
            ->name("Firstname")
            ->isLogged()
            ->microData("http://schema.org/Person", "familyName")
            ->association("firstname", "lastname")
        ;
        //====================================================================//
        // Lastname
        $factory->create(SPL_T_VARCHAR)
            ->identifier("lastname")
            ->name("Lastname")
            ->isLogged()
            ->microData("http://schema.org/Person", "givenName")
            ->association("firstname", "lastname")
        ;
        //====================================================================//
        // Phone Pro
        $factory->create(SPL_T_PHONE)
            ->Identifier("phone")
            ->name("Phone")
            ->microData("http://schema.org/Person", "telephone")
            ->isIndexed()
        ;
    }

    /**
     * {@inheritDoc}
     */
    public function getExtendedFields(object $object, string $fieldId, &$fieldData = null): ?bool
    {
        //====================================================================//
        // Safety Check
        if (!$object instanceof User) {
            return false;
        }

        //====================================================================//
        // READ Fields
        switch ($fieldId) {
            case 'firstname':
            case 'lastname':
            case 'phone':
            case 'website':
                $this->object = $object;
                $this->getGeneric($fieldId);
                $fieldData = $this->out[$fieldId] ?? null;

                return true;
            default:
                return null;
        }
    }

    /**
     * {@inheritDoc}
     */
    public function setExtendedFields(object $object, string $fieldId, $fieldData): ?bool
    {
        //====================================================================//
        // Safety Check
        if (!$object instanceof User) {
            return false;
        }
        //====================================================================//
        // WRITE Fields
        switch ($fieldId) {
            case 'firstname':
            case 'lastname':
            case 'phone':
            case 'website':
                $this->object = $object;
                $this->isUpdated();
                $this->setGeneric($fieldId, $fieldData);

                return $this->isToUpdate();
            default:
                return null;
        }
    }
}
