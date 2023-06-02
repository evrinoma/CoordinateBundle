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

namespace Evrinoma\CoordinateBundle\Manager;

use Evrinoma\CoordinateBundle\Dto\CoordinateApiDtoInterface;
use Evrinoma\CoordinateBundle\Exception\CoordinateCannotBeCreatedException;
use Evrinoma\CoordinateBundle\Exception\CoordinateCannotBeRemovedException;
use Evrinoma\CoordinateBundle\Exception\CoordinateCannotBeSavedException;
use Evrinoma\CoordinateBundle\Exception\CoordinateInvalidException;
use Evrinoma\CoordinateBundle\Exception\CoordinateNotFoundException;
use Evrinoma\CoordinateBundle\Factory\Coordinate\FactoryInterface;
use Evrinoma\CoordinateBundle\Mediator\CommandMediatorInterface;
use Evrinoma\CoordinateBundle\Model\Coordinate\CoordinateInterface;
use Evrinoma\CoordinateBundle\Repository\Coordinate\CoordinateRepositoryInterface;
use Evrinoma\UtilsBundle\Validator\ValidatorInterface;

final class CommandManager implements CommandManagerInterface
{
    private CoordinateRepositoryInterface $repository;
    private ValidatorInterface            $validator;
    private FactoryInterface           $factory;
    private CommandMediatorInterface      $mediator;

    /**
     * @param ValidatorInterface            $validator
     * @param CoordinateRepositoryInterface $repository
     * @param FactoryInterface              $factory
     * @param CommandMediatorInterface      $mediator
     */
    public function __construct(ValidatorInterface $validator, CoordinateRepositoryInterface $repository, FactoryInterface $factory, CommandMediatorInterface $mediator)
    {
        $this->validator = $validator;
        $this->repository = $repository;
        $this->factory = $factory;
        $this->mediator = $mediator;
    }

    /**
     * @param CoordinateApiDtoInterface $dto
     *
     * @return CoordinateInterface
     *
     * @throws CoordinateInvalidException
     * @throws CoordinateCannotBeCreatedException
     * @throws CoordinateCannotBeSavedException
     */
    public function post(CoordinateApiDtoInterface $dto): CoordinateInterface
    {
        $coordinate = $this->factory->create($dto);

        $this->mediator->onCreate($dto, $coordinate);

        $errors = $this->validator->validate($coordinate);

        if (\count($errors) > 0) {
            $errorsString = (string) $errors;

            throw new CoordinateInvalidException($errorsString);
        }

        $this->repository->save($coordinate);

        return $coordinate;
    }

    /**
     * @param CoordinateApiDtoInterface $dto
     *
     * @return CoordinateInterface
     *
     * @throws CoordinateInvalidException
     * @throws CoordinateNotFoundException
     * @throws CoordinateCannotBeSavedException
     */
    public function put(CoordinateApiDtoInterface $dto): CoordinateInterface
    {
        try {
            $coordinate = $this->repository->find($dto->idToString());
        } catch (CoordinateNotFoundException $e) {
            throw $e;
        }

        $this->mediator->onUpdate($dto, $coordinate);

        $errors = $this->validator->validate($coordinate);

        if (\count($errors) > 0) {
            $errorsString = (string) $errors;

            throw new CoordinateInvalidException($errorsString);
        }

        $this->repository->save($coordinate);

        return $coordinate;
    }

    /**
     * @param CoordinateApiDtoInterface $dto
     *
     * @throws CoordinateCannotBeRemovedException
     * @throws CoordinateNotFoundException
     */
    public function delete(CoordinateApiDtoInterface $dto): void
    {
        try {
            $coordinate = $this->repository->find($dto->idToString());
        } catch (CoordinateNotFoundException $e) {
            throw $e;
        }
        $this->mediator->onDelete($dto, $coordinate);
        try {
            $this->repository->remove($coordinate);
        } catch (CoordinateCannotBeRemovedException $e) {
            throw $e;
        }
    }
}
