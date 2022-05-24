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

namespace Splash\Connectors\FosUser\Objects\User;

/**
 * Core Fields (Required)
 */
trait CoreTrait
{
    /**
     * Build Fields using FieldFactory
     *
     * @return void
     */
    protected function buildCoreFields()
    {
        //====================================================================//
        // Username
        $this->fieldsFactory()->create(SPL_T_VARCHAR)
            ->identifier("username")
            ->name("Username")
            ->isLogged()
            ->microData("http://schema.org/Organization", "legalName")
            ->isRequired()
            ->isListed();

        //====================================================================//
        // Email
        $this->fieldsFactory()->create(SPL_T_EMAIL)
            ->identifier("email")
            ->name("Email")
            ->microData("http://schema.org/ContactPoint", "email")
            ->isRequired()
            ->isListed();

        //====================================================================//
        // Active
        $this->fieldsFactory()->create(SPL_T_BOOL)
            ->identifier("enabled")
            ->name("Enabled")
            ->microData("http://schema.org/Organization", "active")
            ->isListed();
    }

    /**
     * Read requested Field
     *
     * @param string $key       Input List Key
     * @param string $fieldName Field Identifier / Name
     *
     * @return void
     */
    protected function getCoreFields($key, $fieldName)
    {
        //====================================================================//
        // READ Fields
        switch ($fieldName) {
            case 'username':
            case 'email':
                $this->getGeneric($fieldName);

                break;
            case 'enabled':
                $this->getGenericBool($fieldName);

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
    protected function setCoreFields($fieldName, $fieldData)
    {
        //====================================================================//
        // WRITE Field
        switch ($fieldName) {
            case 'username':
            case 'email':
                $this->setGeneric($fieldName, $fieldData);

                break;
            case 'enabled':
                $this->setGenericBool($fieldName, $fieldData);

                break;
            default:
                return;
        }
        unset($this->in[$fieldName]);
    }
}
