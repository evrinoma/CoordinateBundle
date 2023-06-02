<?php

declare(strict_types=1);

/*
 * This file is part of the package.
 *
 * (c) Nikolay Nikolaev <evrinoma@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Evrinoma\CoordinateBundle\Repository\Coordinate;

use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\ORMInvalidArgumentException;
use Evrinoma\CoordinateBundle\Dto\CoordinateApiDtoInterface;
use Evrinoma\CoordinateBundle\Exception\CoordinateCannotBeRemovedException;
use Evrinoma\CoordinateBundle\Exception\CoordinateCannotBeSavedException;
use Evrinoma\CoordinateBundle\Exception\CoordinateNotFoundException;
use Evrinoma\CoordinateBundle\Exception\CoordinateProxyException;
use Evrinoma\CoordinateBundle\Mediator\QueryMediatorInterface;
use Evrinoma\CoordinateBundle\Model\Coordinate\CoordinateInterface;

trait CoordinateRepositoryTrait
{
    private QueryMediatorInterface $mediator;

    /**
     * @param CoordinateInterface $coordinate
     *
     * @return bool
     *
     * @throws CoordinateCannotBeSavedException
     * @throws ORMException
     */
    public function save(CoordinateInterface $coordinate): bool
    {
        try {
            $this->persistWrapped($coordinate);
        } catch (ORMInvalidArgumentException $e) {
            throw new CoordinateCannotBeSavedException($e->getMessage());
        }

        return true;
    }

    /**
     * @param CoordinateInterface $coordinate
     *
     * @return bool
     */
    public function remove(CoordinateInterface $coordinate): bool
    {
        try {
            $this->getEntityManager()->remove($coordinate);
        } catch (ORMInvalidArgumentException $e) {
            throw new CoordinateCannotBeRemovedException($e->getMessage());
        }

        return true;
    }

    /**
     * @param CoordinateApiDtoInterface $dto
     *
     * @return array
     *
     * @throws CoordinateNotFoundException
     */
    public function findByCriteria(CoordinateApiDtoInterface $dto): array
    {
        $builder = $this->createQueryBuilderWrapped($this->mediator->alias());

        $this->mediator->createQuery($dto, $builder);

        $coordinates = $this->mediator->getResult($dto, $builder);

        if (0 === \count($coordinates)) {
            throw new CoordinateNotFoundException('Cannot find coordinate by findByCriteria');
        }

        return $coordinates;
    }

    /**
     * @param      $id
     * @param null $lockMode
     * @param null $lockVersion
     *
     * @return mixed
     *
     * @throws CoordinateNotFoundException
     */
    public function find($id, $lockMode = null, $lockVersion = null): CoordinateInterface
    {
        /** @var CoordinateInterface $coordinate */
        $coordinate = $this->findWrapped($id);

        if (null === $coordinate) {
            throw new CoordinateNotFoundException("Cannot find coordinate with id $id");
        }

        return $coordinate;
    }

    /**
     * @param string $id
     *
     * @return CoordinateInterface
     *
     * @throws CoordinateProxyException
     * @throws ORMException
     */
    public function proxy(string $id): CoordinateInterface
    {
        $coordinate = $this->referenceWrapped($id);

        if (!$this->containsWrapped($coordinate)) {
            throw new CoordinateProxyException("Proxy doesn't exist with $id");
        }

        return $coordinate;
    }
}
