<?php

namespace App\Http\Controllers\API\Products\Sales;

use App\Http\Requests\API\Products\Sales\CreateInventoryAPIRequest;
use App\Http\Requests\API\Products\Sales\UpdateInventoryAPIRequest;
use App\Models\Products\Sales\Inventory;
use App\Repositories\Products\Sales\InventoryRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class InventoryController
 * @package App\Http\Controllers\API\Products\Sales
 */

class InventoryAPIController extends AppBaseController
{
    /** @var  InventoryRepository */
    private $inventoryRepository;

    public function __construct(InventoryRepository $inventoryRepo)
    {
        $this->inventoryRepository = $inventoryRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/inventories",
     *      summary="Get a listing of the Inventories.",
     *      tags={"Inventory"},
     *      description="Get all Inventories",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/Inventory")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        $inventories = $this->inventoryRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($inventories->toArray(), 'Inventories retrieved successfully');
    }

    /**
     * @param CreateInventoryAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/inventories",
     *      summary="Store a newly created Inventory in storage",
     *      tags={"Inventory"},
     *      description="Store Inventory",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Inventory that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Inventory")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Inventory"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateInventoryAPIRequest $request)
    {
        $input = $request->all();

        $inventory = $this->inventoryRepository->create($input);

        return $this->sendResponse($inventory->toArray(), 'Inventory saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/inventories/{id}",
     *      summary="Display the specified Inventory",
     *      tags={"Inventory"},
     *      description="Get Inventory",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Inventory",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Inventory"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var Inventory $inventory */
        $inventory = $this->inventoryRepository->find($id);

        if (empty($inventory)) {
            return $this->sendError('Inventory not found');
        }

        return $this->sendResponse($inventory->toArray(), 'Inventory retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateInventoryAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/inventories/{id}",
     *      summary="Update the specified Inventory in storage",
     *      tags={"Inventory"},
     *      description="Update Inventory",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Inventory",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Inventory that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Inventory")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Inventory"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateInventoryAPIRequest $request)
    {
        $input = $request->all();

        /** @var Inventory $inventory */
        $inventory = $this->inventoryRepository->find($id);

        if (empty($inventory)) {
            return $this->sendError('Inventory not found');
        }

        $inventory = $this->inventoryRepository->update($input, $id);

        return $this->sendResponse($inventory->toArray(), 'Inventory updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/inventories/{id}",
     *      summary="Remove the specified Inventory from storage",
     *      tags={"Inventory"},
     *      description="Delete Inventory",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Inventory",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        /** @var Inventory $inventory */
        $inventory = $this->inventoryRepository->find($id);

        if (empty($inventory)) {
            return $this->sendError('Inventory not found');
        }

        $inventory->delete();

        return $this->sendSuccess('Inventory deleted successfully');
    }
}
