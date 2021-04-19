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

use Sonata\UserBundle\Model\UserInterface;

/**
 * Sonata Meta Fields
 */
trait SonataMetaTrait
{
    /**
     * Build Fields using FieldFactory
     *
     * @return void
     */
    protected function buildSonataMetaFields()
    {
        //====================================================================//
        // Check if Sonata User is Active
        if (!$this->hasSonataUser()) {
            return;
        }
        //====================================================================//
        // Creation Date
        $this->fieldsFactory()->create(SPL_T_DATETIME)
            ->identifier("createdAt")
            ->name("Created")
            ->group("Meta")
            ->microData("http://schema.org/DataFeedItem", "dateCreated")
            ->isReadOnly()
        ;
        //====================================================================//
        // Update Date
        $this->fieldsFactory()->create(SPL_T_DATETIME)
            ->identifier("updatedAt")
            ->name("Updated")
            ->group("Meta")
            ->microData("http://schema.org/DataFeedItem", "dateModified")
            ->isReadOnly()
        ;
        //====================================================================//
        // Gender Type
        $this->fieldsFactory()->create(SPL_T_INT)
            ->identifier("gender")
            ->Name("Social Title (ID)")
            ->microData("http://schema.org/Person", "gender")
            ->description("Social Title : 0 => Male // 1 => Female // 2 => Neutral")
            ->addChoices(array("0" => "Male", "1" => "Female", "2" => "Unknown"))
            ->isNotTested();
    }

    /**
     * Read requested Field
     *
     * @param string $key       Input List Key
     * @param string $fieldName Field Identifier / Name
     *
     * @return void
     */
    protected function getSonataMetaFields($key, $fieldName)
    {
        //====================================================================//
        // Check if Sonata User is Active
        if (!$this->hasSonataUser()) {
            return;
        }
        //====================================================================//
        // READ Fields
        switch ($fieldName) {
            case 'createdAt':
            case 'updatedAt':
                $this->getGenericDateTime($fieldName);

                break;
            case 'gender':
                $this->out[$fieldName] = $this->getGender();

                break;
            default:
                return;
        }

        unset($this->in[$key]);
    }

    /**
     * Read User Gender Int Value
     *
     * @return int
     */
    private function getGender(): int
    {
        if (!($this->object instanceof UserInterface)) {
            return 2;
        }
        switch ($this->object->getGender()) {
            case UserInterface::GENDER_MALE:
                return 0;
            case UserInterface::GENDER_FEMALE:
                return 1;
            case UserInterface::GENDER_UNKNOWN:
                return 2;
        }

        return 2;
    }
}
