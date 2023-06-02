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

namespace Evrinoma\CoordinateBundle\Controller;

use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Evrinoma\CoordinateBundle\Dto\CoordinateApiDtoInterface;
use Evrinoma\CoordinateBundle\Exception\CoordinateCannotBeSavedException;
use Evrinoma\CoordinateBundle\Exception\CoordinateInvalidException;
use Evrinoma\CoordinateBundle\Exception\CoordinateNotFoundException;
use Evrinoma\CoordinateBundle\Facade\Coordinate\FacadeInterface;
use Evrinoma\CoordinateBundle\Serializer\GroupInterface;
use Evrinoma\DtoBundle\Factory\FactoryDtoInterface;
use Evrinoma\UtilsBundle\Controller\AbstractWrappedApiController;
use Evrinoma\UtilsBundle\Controller\ApiControllerInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use JMS\Serializer\SerializerInterface;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

final class CoordinateApiController extends AbstractWrappedApiController implements ApiControllerInterface
{
    private string $dtoClass;

    private ?Request $request;

    private FactoryDtoInterface $factoryDto;

    private FacadeInterface $facade;

    public function __construct(
        SerializerInterface $serializer,
        RequestStack $requestStack,
        FactoryDtoInterface $factoryDto,
        FacadeInterface $facade,
        string $dtoClass
    ) {
        parent::__construct($serializer);
        $this->request = $requestStack->getCurrentRequest();
        $this->factoryDto = $factoryDto;
        $this->dtoClass = $dtoClass;
        $this->facade = $facade;
    }

    /**
     * @Rest\Post("/api/coordinate/create", options={"expose": true}, name="api_coordinate_create")
     * @OA\Post(
     *     tags={"coordinate"},
     *     description="the method perform create coordinate",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 example={
     *                     "class": "Evrinoma\CoordinateBundle\Dto\CoordinateApiDto",
     *                     "altitude": "48.01",
     *                     "latitude": "66.816615",
     *                     "longitude": "65.801109",
     *                 },
     *                 type="object",
     *                 @OA\Property(property="class", type="string", default="Evrinoma\CoordinateBundle\Dto\CoordinateApiDto"),
     *                 @OA\Property(property="altitude", type="float"),
     *                 @OA\Property(property="latitude", type="float"),
     *                 @OA\Property(property="longitude", type="float"),
     *             )
     *         )
     *     )
     * )
     * @OA\Response(response=200, description="Create coordinate")
     *
     * @return JsonResponse
     */
    public function postAction(): JsonResponse
    {
        /** @var CoordinateApiDtoInterface $coordinateApiDto */
        $coordinateApiDto = $this->factoryDto->setRequest($this->request)->createDto($this->dtoClass);

        $this->setStatusCreated();

        $json = [];
        $error = [];
        $group = GroupInterface::API_POST_COORDINATE;

        try {
            $this->facade->post($coordinateApiDto, $group, $json);
        } catch (\Exception $e) {
            $json = [];
            $error = $this->setRestStatus($e);
        }

        return $this->setSerializeGroup($group)->JsonResponse('Create coordinate', $json, $error);
    }

    /**
     * @Rest\Put("/api/coordinate/save", options={"expose": true}, name="api_coordinate_save")
     * @OA\Put(
     *     tags={"coordinate"},
     *     description="the method perform save coordinate for current entity",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 example={
     *                     "class": "Evrinoma\CoordinateBundle\Dto\CoordinateApiDto",
     *                     "id": "48",
     *                     "altitude": "48.01",
     *                     "latitude": "66.816615",
     *                     "longitude": "65.801109",
     *                 },
     *                 type="object",
     *                 @OA\Property(property="class", type="string", default="Evrinoma\CoordinateBundle\Dto\CoordinateApiDto"),
     *                 @OA\Property(property="id", type="string"),
     *                 @OA\Property(property="altitude", type="float"),
     *                 @OA\Property(property="latitude", type="float"),
     *                 @OA\Property(property="longitude", type="float"),
     *             )
     *         )
     *     )
     * )
     * @OA\Response(response=200, description="Save coordinate")
     * @return JsonResponse
     */
    public function putAction(): JsonResponse
    {
        /** @var CoordinateApiDtoInterface $coordinateApiDto */
        $coordinateApiDto = $this->factoryDto->setRequest($this->request)->createDto($this->dtoClass);

        $json = [];
        $error = [];
        $group = GroupInterface::API_PUT_COORDINATE;

        try {
            $this->facade->put($coordinateApiDto, $group, $json);
        } catch (\Exception $e) {
            $json = [];
            $error = $this->setRestStatus($e);
        }

        return $this->setSerializeGroup($group)->JsonResponse('Save coordinate', $json, $error);
    }

    /**
     * @Rest\Delete("/api/coordinate/delete", options={"expose": true}, name="api_coordinate_delete")
     * @OA\Delete(
     *     tags={"coordinate"},
     *     @OA\Parameter(
     *         description="class",
     *         in="query",
     *         name="class",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             default="Evrinoma\CoordinateBundle\Dto\CoordinateApiDto",
     *             readOnly=true
     *         )
     *     ),
     *     @OA\Parameter(
     *         description="id Entity",
     *         in="query",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             default="3",
     *         )
     *     )
     * )
     * @OA\Response(response=200, description="Delete coordinate")
     *
     * @return JsonResponse
     */
    public function deleteAction(): JsonResponse
    {
        /** @var CoordinateApiDtoInterface $coordinateApiDto */
        $coordinateApiDto = $this->factoryDto->setRequest($this->request)->createDto($this->dtoClass);

        $this->setStatusAccepted();

        $json = [];
        $error = [];

        try {
            $this->facade->delete($coordinateApiDto, '', $json);
        } catch (\Exception $e) {
            $json = [];
            $error = $this->setRestStatus($e);
        }

        return $this->JsonResponse('Delete coordinate', $json, $error);
    }

    /**
     * @Rest\Get("/api/coordinate/criteria", options={"expose": true}, name="api_coordinate_criteria")
     * @OA\Get(
     *     tags={"coordinate"},
     *     @OA\Parameter(
     *         description="class",
     *         in="query",
     *         name="class",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             default="Evrinoma\CoordinateBundle\Dto\CoordinateApiDto",
     *             readOnly=true
     *         )
     *     ),
     *     @OA\Parameter(
     *         description="id Entity",
     *         in="query",
     *         name="id",
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *     @OA\Parameter(
     *         description="longitude",
     *         in="query",
     *         name="longitude",
     *         @OA\Schema(
     *             type="float",
     *         )
     *     ),
     *     @OA\Parameter(
     *         description="latitude",
     *         in="query",
     *         name="latitude",
     *         @OA\Schema(
     *             type="float",
     *         )
     *     ),
     *     @OA\Parameter(
     *         description="altitude",
     *         in="query",
     *         name="altitude",
     *         @OA\Schema(
     *             type="float",
     *         )
     *     ),
     * )
     *
     * @OA\Response(response=200, description="Return coordinate")
     *
     * @return JsonResponse
     */
    public function criteriaAction(): JsonResponse
    {
        /** @var CoordinateApiDtoInterface $coordinateApiDto */
        $coordinateApiDto = $this->factoryDto->setRequest($this->request)->createDto($this->dtoClass);

        $json = [];
        $error = [];
        $group = GroupInterface::API_CRITERIA_COORDINATE;

        try {
            $this->facade->criteria($coordinateApiDto, $group, $json);
        } catch (\Exception $e) {
            $json = [];
            $error = $this->setRestStatus($e);
        }

        return $this->setSerializeGroup($group)->JsonResponse('Get coordinate', $json, $error);
    }

    /**
     * @Rest\Get("/api/coordinate", options={"expose": true}, name="api_coordinate")
     * @OA\Get(
     *     tags={"coordinate"},
     *     @OA\Parameter(
     *         description="class",
     *         in="query",
     *         name="class",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             default="Evrinoma\CoordinateBundle\Dto\CoordinateApiDto",
     *             readOnly=true
     *         )
     *     ),
     *     @OA\Parameter(
     *         description="id Entity",
     *         in="query",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             default="3",
     *         )
     *     )
     * )
     * @OA\Response(response=200, description="Return coordinate")
     *
     * @return JsonResponse
     */
    public function getAction(): JsonResponse
    {
        /** @var CoordinateApiDtoInterface $coordinateApiDto */
        $coordinateApiDto = $this->factoryDto->setRequest($this->request)->createDto($this->dtoClass);

        $json = [];
        $error = [];
        $group = GroupInterface::API_GET_COORDINATE;

        try {
            $this->facade->get($coordinateApiDto, $group, $json);
        } catch (\Exception $e) {
            $json = [];
            $error = $this->setRestStatus($e);
        }

        return $this->setSerializeGroup($group)->JsonResponse('Get coordinate', $json, $error);
    }

    /**
     * @param \Exception $e
     *
     * @return array
     */
    public function setRestStatus(\Exception $e): array
    {
        switch (true) {
            case $e instanceof CoordinateCannotBeSavedException:
                $this->setStatusNotImplemented();
                break;
            case $e instanceof UniqueConstraintViolationException:
                $this->setStatusConflict();
                break;
            case $e instanceof CoordinateNotFoundException:
                $this->setStatusNotFound();
                break;
            case $e instanceof CoordinateInvalidException:
                $this->setStatusUnprocessableEntity();
                break;
            default:
                $this->setStatusBadRequest();
        }

        return [$e->getMessage()];
    }
}
