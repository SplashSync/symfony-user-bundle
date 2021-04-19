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
 * Sonata Fields
 */
trait SonataTrait
{
    /**
     * Build Fields using FieldFactory
     *
     * @return void
     */
    protected function buildSonataFields()
    {
        //====================================================================//
        // Check if Sonata User is Active
        if (!$this->hasSonataUser()) {
            return;
        }
        //====================================================================//
        // Firstname
        $this->fieldsFactory()->create(SPL_T_VARCHAR)
            ->identifier("firstname")
            ->name("Firstname")
            ->isLogged()
            ->microData("http://schema.org/Person", "familyName")
            ->association("firstname", "lastname")
        ;
        //====================================================================//
        // Lastname
        $this->fieldsFactory()->create(SPL_T_VARCHAR)
            ->identifier("lastname")
            ->name("Lastname")
            ->isLogged()
            ->microData("http://schema.org/Person", "givenName")
            ->association("firstname", "lastname")
        ;
        //====================================================================//
        // Phone Pro
        $this->fieldsFactory()->create(SPL_T_PHONE)
            ->Identifier("phone")
            ->name("Phone")
            ->microData("http://schema.org/Person", "telephone")
        ;
        //====================================================================//
        // WebSite
        $this->fieldsFactory()->create(SPL_T_URL)
            ->identifier("website")
            ->name("Website")
            ->microData("http://schema.org/Organization", "url")
        ;
    }

    /**
     * Read requested Field
     *
     * @param string $key       Input List Key
     * @param string $fieldName Field Identifier / Name
     *
     * @return void
     */
    protected function getSonataFields($key, $fieldName)
    {
        //====================================================================//
        // Check if Sonata User is Active
        if (!$this->hasSonataUser()) {
            return;
        }
        //====================================================================//
        // READ Fields
        switch ($fieldName) {
            case 'firstname':
            case 'lastname':
            case 'phone':
            case 'website':
                $this->getGeneric($fieldName);

                break;
            default:
                return;
        }

        unset($this->in[$key]);
    }

    /**
     * Write Given Fields
     *
     * @param string $fieldName Field Identifier / Name
     * @param mixed  $fieldData Field Data
     *
     * @return void
     */
    protected function setSonataFields($fieldName, $fieldData)
    {
        //====================================================================//
        // Check if Sonata User is Active
        if (!$this->hasSonataUser()) {
            return;
        }
        //====================================================================//
        // WRITE Field
        switch ($fieldName) {
            case 'firstname':
            case 'lastname':
            case 'phone':
            case 'website':
                $this->setGeneric($fieldName, $fieldData);

                break;
            default:
                return;
        }
        unset($this->in[$fieldName]);
    }

    /**
     * Check if Application uses Sonata User Bundle
     *
     * @return bool
     */
    protected function hasSonataUser(): bool
    {
        static $hasSonata = null;
        if (!isset($hasSonata)) {
            $hasSonata = is_subclass_of($this->manager->getClass(), UserInterface::class);
        }

        return $hasSonata;
    }
}
