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

use Doctrine\ORM\QueryBuilder;
use FOS\UserBundle\Model\UserInterface;
use Splash\Bundle\Helpers\Doctrine\ObjectsListHelperTrait;

trait ObjectListTrait
{
    use ObjectsListHelperTrait;

    /**
     * Setup List Query Builder Filters
     *
     * @param QueryBuilder $queryBuilder
     * @param string       $filter
     *
     * @return void
     */
    public function setObjectListFilter(QueryBuilder $queryBuilder, string $filter): void
    {
        $queryBuilder->andWhere($queryBuilder->expr()->orX(
            $queryBuilder->expr()->like("c.username", ":filter"),
            $queryBuilder->expr()->like("c.email", ":filter")
        ))
            ->setParameter("filter", '%'.$filter.'%')
        ;
    }

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
            'enabled' => $user->isEnabled(),
        );
    }
}
