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
        try {
            $inventories = $this->inventoryRepository->relations();

            if ( ! empty($inventories) ) 
                return response()->json($inventories, 200);

            return response()->json(array('info' => 'No se encontraron datos.', 'status' => '204'));
        } catch (Illuminate\Database\QueryException $e) {
            return response()->json(array('info' => 'Ha ocurrido un error con la base de datos'), 500);
        }
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

        try {
            $inventory = $this->inventoryRepository->create($input);

            return response()->json($inventory->toArray(), 201);
        } catch (Illuminate\Database\QueryException $e) {
            return response()->json(array('info' => 'Ha ocurrido un error con la base de datos'), 500);
        }
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
        try {
            /** @var Inventory $inventory */
            $inventory = $this->inventoryRepository->relations()->find($id);
            
            if ( empty($inventory) ) 
                return response()->json(array('info' => 'Inventario no encontrado.', 'status' => '204'));

            return response()->json($inventory->toArray(), 200);
        } catch (Illuminate\Database\QueryException $e) {
            return response()->json(array('info' => 'Ha ocurrido un error con la base de datos'), 500);
        }
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
        try {
            $input = $request->all();

            /** @var Inventory $inventory */
            $inventory = $this->inventoryRepository->find($id);

            if (empty($inventory)) 
                return response()->json(array('info' => 'El inventario no puede ser actualizado.', 'status' => '204'));            

            $inventory = $this->inventoryRepository->update($input, $id);

            return response()->json($inventory->toArray(), 201);
        } catch (Illuminate\Database\QueryException $e) {
            return response()->json(array('info' => 'Ha ocurrido un error con la base de datos'), 500);
        }
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
        try {
            /** @var Inventory $inventory */
            $inventory = $this->inventoryRepository->find($id);

            if (empty($inventory))
                return response()->json(array('info' => 'El inventario no puede ser eliminado.', 'status' => '204'));

            $inventory->delete();

            return response()->json($inventory->toArray(), 202);
        } catch (Illuminate\Database\QueryException $e) {
            return response()->json(array('info' => 'Ha ocurrido un error con la base de datos'), 500);
        }
    }
}
