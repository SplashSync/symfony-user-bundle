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
use Splash\Bundle\Helpers\Doctrine\ObjectsListHelperTrait;

trait ObjectListTrait
{
    use ObjectsListHelperTrait;

    /**
     * Transform FOS User To List Array Data
     *
     * @param UserInterface $user
     *
     * @return array
     */
    protected function getObjectListArray(UserInterface $user): array
    {
        return array(
            'id' => $user->getId(),
            'username' => $user->getUsername(),
            'email' => $user->getEmail(),
        );
    }
}
