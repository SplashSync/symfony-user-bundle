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
use Splash\Client\Splash;

trait PrimaryTrait
{
    /**
     * @inheritDoc
     */
    public function getByPrimary(array $keys): ?string
    {
        //====================================================================//
        // Stack Trace
        Splash::log()->trace();
        //====================================================================//
        // Extract User Email
        $email = $keys["email"] ?? null;
        if (empty($email) || !is_string($email)) {
            return null;
        }
        //====================================================================//
        // Prepare Query Builder
        /** @var QueryBuilder $queryBuilder */
        $queryBuilder = $this->repository->createQueryBuilder('c');
        // Limit Results Number
        $queryBuilder->setMaxResults(5);
        //====================================================================//
        // Pre Setup Query Builder
        if (method_exists($this, "configureObjectListQueryBuilder")) {
            $this->configureObjectListQueryBuilder($queryBuilder);
        }
        //====================================================================//
        // Setup Primary Query Builder
        $queryBuilder->andWhere(
            $queryBuilder->expr()->eq("c.emailCanonical", ":email")
        )
            ->setParameter("email", strtolower($email))
        ;
        //====================================================================//
        // Load Objects List
        /** @var null|array[] $rawData */
        $rawData = $queryBuilder->getQuery()->getArrayResult();
        //====================================================================//
        // Ensure Single Result Found
        if (!is_array($rawData) || (1 != count($rawData))) {
            return null;
        }
        foreach ($rawData as $object) {
            if (!empty($object['id'] ?? null)) {
                return $object['id'];
            }
        }

        return null;
    }
}
