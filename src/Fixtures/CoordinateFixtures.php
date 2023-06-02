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

namespace Evrinoma\CoordinateBundle\Fixtures;

use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Evrinoma\CoordinateBundle\Dto\CoordinateApiDtoInterface;
use Evrinoma\CoordinateBundle\Entity\Coordinate\BaseCoordinate;
use Evrinoma\TestUtilsBundle\Fixtures\AbstractFixture;

class CoordinateFixtures extends AbstractFixture implements FixtureGroupInterface, OrderedFixtureInterface
{
    protected static array $data = [
        [
            CoordinateApiDtoInterface::ALTITUDE => '10.2',
            CoordinateApiDtoInterface::LATITUDE => '58.200891',
            CoordinateApiDtoInterface::LONGITUDE => '68.253995',
            'created_at' => '2008-10-23 10:21:50',
        ],
        [
            CoordinateApiDtoInterface::ALTITUDE => '100.2',
            CoordinateApiDtoInterface::LATITUDE => '70.164391',
            CoordinateApiDtoInterface::LONGITUDE => 72.508354,
            'created_at' => '2015-10-23 10:21:50',
        ],
        [
            CoordinateApiDtoInterface::ALTITUDE => '0.25',
            CoordinateApiDtoInterface::LATITUDE => 66.816615,
            CoordinateApiDtoInterface::LONGITUDE => 65.801109,
            'created_at' => '2020-10-23 10:21:50',
        ],
        [
            CoordinateApiDtoInterface::ALTITUDE => -10.2,
            CoordinateApiDtoInterface::LATITUDE => '55.441004',
            CoordinateApiDtoInterface::LONGITUDE => '65.341118',
            'created_at' => '2015-10-23 10:21:50',
            ],
        [
            CoordinateApiDtoInterface::ALTITUDE => 68.253995,
            CoordinateApiDtoInterface::LATITUDE => 58.200891,
            CoordinateApiDtoInterface::LONGITUDE => 68.253995,
            'created_at' => '2010-10-23 10:21:50',
        ],
        [
            CoordinateApiDtoInterface::ALTITUDE => -168.253995,
            CoordinateApiDtoInterface::LATITUDE => '55.441004',
            CoordinateApiDtoInterface::LONGITUDE => '65.341118',
            'created_at' => '2010-10-23 10:21:50',
            ],
        [
            CoordinateApiDtoInterface::ALTITUDE => 68.9,
            CoordinateApiDtoInterface::LATITUDE => '55.753220',
            CoordinateApiDtoInterface::LONGITUDE => '37.622513',
            'created_at' => '2011-10-23 10:21:50',
        ],
    ];

    protected static string $class = BaseCoordinate::class;

    /**
     * @param ObjectManager $manager
     *
     * @return $this
     *
     * @throws \Exception
     */
    protected function create(ObjectManager $manager): self
    {
        $short = static::getReferenceName();
        $i = 0;

        foreach ($this->getData() as $record) {
            $entity = $this->getEntity();
            $entity
                ->setAltitude($record[CoordinateApiDtoInterface::ALTITUDE])
                ->setLatitude($record[CoordinateApiDtoInterface::LATITUDE])
                ->setLongitude($record[CoordinateApiDtoInterface::LONGITUDE])
                ->setCreatedAt(new \DateTimeImmutable($record['created_at']));

            $this->expandEntity($entity, $record);

            $this->addReference($short.$i, $entity);
            $manager->persist($entity);
            $i++;
        }

        return $this;
    }

    public static function getGroups(): array
    {
        return [
            FixtureInterface::COORDINATE_FIXTURES,
        ];
    }

    public function getOrder()
    {
        return 0;
    }
}
