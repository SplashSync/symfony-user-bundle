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

use Splash\Core\Dictionary\SplFields;
use Splash\Core\Helpers\InlineHelper;

/**
 * Core Fields (Required)
 */
trait CoreTrait
{
    /**
     * Build Fields using FieldFactory
     */
    protected function buildCoreFields(): void
    {
        //====================================================================//
        // Username
        $this->fieldsFactory()->create(SplFields::VARCHAR)
            ->identifier("username")
            ->name("Username")
            ->isLogged()
            ->microData("http://schema.org/Organization", "legalName")
            ->isRequired()
            ->isIndexed()
            ->isListed()
        ;
        //====================================================================//
        // Email
        $this->fieldsFactory()->create(SplFields::EMAIL)
            ->identifier("email")
            ->name("Email")
            ->microData("http://schema.org/ContactPoint", "email")
            ->isRequired()
            ->isPrimary()
            ->isListed()
        ;
        //====================================================================//
        // Roles
        $this->fieldsFactory()->create(SplFields::INLINE)
            ->identifier("roles")
            ->name("User Roles")
            ->isReadOnly()
        ;
        //====================================================================//
        // Active
        $this->fieldsFactory()->create(SplFields::BOOL)
            ->identifier("enabled")
            ->name("Enabled")
            ->microData("http://schema.org/Organization", "active")
            ->isListed()
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
    protected function getCoreFields(string $key, string $fieldName)
    {
        //====================================================================//
        // READ Fields
        switch ($fieldName) {
            case 'username':
            case 'email':
                $this->getGeneric($fieldName);

                break;
            case 'roles':
                $this->out[$fieldName] = InlineHelper::fromArray($this->object->getRoles());

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
     * @param string      $fieldName Field Identifier / Name
     * @param null|string $fieldData Field Data
     *
     * @return void
     */
    protected function setCoreFields(string $fieldName, ?string $fieldData): void
    {
        //====================================================================//
        // WRITE Field
        switch ($fieldName) {
            case 'username':
            case 'email':
                $this->setGeneric($fieldName, $fieldData);

                break;
            default:
                return;
        }
        unset($this->in[$fieldName]);
    }

    /**
     * Write Given Fields
     *
     * @param string    $fieldName Field Identifier / Name
     * @param null|bool $fieldData Field Data
     *
     * @return void
     */
    protected function setCoreBoolFields(string $fieldName, ?bool $fieldData): void
    {
        switch ($fieldName) {
            case 'enabled':
                $this->setGenericBool($fieldName, $fieldData);

                break;
            default:
                return;
        }
        unset($this->in[$fieldName]);
    }
}
