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

namespace Splash\Connectors\SymfonyUser\Extensions\Sonata;

use Sonata\UserBundle\Entity\BaseUser;
use Splash\Core\Components\FieldsFactory;
use Splash\Core\Dictionary\SplFields;
use Splash\Core\Interfaces\Extensions\ObjectExtensionInterface;

/**
 * Use Splash Objects Extension to add Sonata User fields on ThirdParty Objects
 */
class MetadataExtension implements ObjectExtensionInterface
{
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
        // Creation Date
        $factory->create(SplFields::DATETIME)
            ->identifier("createdAt")
            ->name("Created")
            ->group("Meta")
            ->microData("http://schema.org/DataFeedItem", "dateCreated")
            ->isReadOnly()
        ;
        //====================================================================//
        // Update Date
        $factory->create(SplFields::DATETIME)
            ->identifier("updatedAt")
            ->name("Updated")
            ->group("Meta")
            ->microData("http://schema.org/DataFeedItem", "dateModified")
            ->isReadOnly()
        ;
    }

    /**
     * {@inheritDoc}
     */
    public function getExtendedFields(object $object, string $fieldId, &$fieldData = null): ?bool
    {
        //====================================================================//
        // Safety Check
        if (!$object instanceof BaseUser) {
            return false;
        }
        //====================================================================//
        // READ Fields
        switch ($fieldId) {
            case 'createdAt':
                $date = $object->getCreatedAt();
                $fieldData = $date ? $date->format('Y-m-d H:i:s') : "";

                return true;
            case 'updatedAt':
                $date = $object->getUpdatedAt();
                $fieldData = $date ? $date->format('Y-m-d H:i:s') : "";

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
        return null;
    }
}
