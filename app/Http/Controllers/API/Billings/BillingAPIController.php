<?php

namespace App\Http\Controllers\API\Billings;

use App\Http\Requests\API\Billings\CreateBillingAPIRequest;
use App\Http\Requests\API\Billings\UpdateBillingAPIRequest;
use App\Models\Billings\Billing;
use App\Repositories\Billings\BillingRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class BillingController
 * @package App\Http\Controllers\API\Billings
 */

class BillingAPIController extends AppBaseController
{
    /** @var  BillingRepository */
    private $billingRepository;

    public function __construct(BillingRepository $billingRepo)
    {
        $this->billingRepository = $billingRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/billings",
     *      summary="Get a listing of the Billings.",
     *      tags={"Billing"},
     *      description="Get all Billings",
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
     *                  @SWG\Items(ref="#/definitions/Billing")
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
            $billings = $this->billingRepository->relations($request);

            if ( ! empty($billings) ) 
                return response()->json($billings, 200);

            return response()->json(array('info' => 'No se encontraron datos.', 'status' => '204'));
        } catch (Illuminate\Database\QueryException $e) {
            return response()->json(array('info' => 'Ha ocurrido un error con la base de datos'), 500);
        }
    }

    /**
     * @param CreateBillingAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/billings",
     *      summary="Store a newly created Billing in storage",
     *      tags={"Billing"},
     *      description="Store Billing",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Billing that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Billing")
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
     *                  ref="#/definitions/Billing"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateBillingAPIRequest $request)
    {
        $input = $request->all();
        
        try {
            $billing = $this->billingRepository->create($input);

            return response()->json($billing->toArray(), 201);
        } catch (Illuminate\Database\QueryException $e) {
            return response()->json(array('info' => 'Ha ocurrido un error con la base de datos'), 500);
        }
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/billings/{id}",
     *      summary="Display the specified Billing",
     *      tags={"Billing"},
     *      description="Get Billing",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Billing",
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
     *                  ref="#/definitions/Billing"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show(Request $request, $id)
    {
        try {
            /** @var Billing $billing */
            $billing = $this->billingRepository->relations($request)->find($id);
                    
            if ( empty($billing) ) 
                return response()->json(array('info' => 'Factura no encontrada.', 'status' => '204'));

            return response()->json($billing->toArray(), 200);
        } catch (Illuminate\Database\QueryException $e) {
            return response()->json(array('info' => 'Ha ocurrido un error con la base de datos'), 500);
        }
    }

    /**
     * @param int $id
     * @param UpdateBillingAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/billings/{id}",
     *      summary="Update the specified Billing in storage",
     *      tags={"Billing"},
     *      description="Update Billing",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Billing",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Billing that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Billing")
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
     *                  ref="#/definitions/Billing"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateBillingAPIRequest $request)
    {
        $input = $request->all();

        try {
            /** @var Billing $billing */
            $billing = $this->billingRepository->find($id);

            if (empty($billing))
                return response()->json(array('info' => 'La factura no puede ser actualizada.', 'status' => '204'));

            $billing = $this->billingRepository->update($input, $id);

            return response()->json($billing->toArray(), 201);
        } catch (Illuminate\Database\QueryException $e) {
            return response()->json(array('info' => 'Ha ocurrido un error con la base de datos'), 500);
        }
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/billings/{id}",
     *      summary="Remove the specified Billing from storage",
     *      tags={"Billing"},
     *      description="Delete Billing",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Billing",
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
            /** @var Billing $billing */
            $billing = $this->billingRepository->find($id);

            if (empty($billing))
                return response()->json(array('info' => 'La factura no puede ser eliminada.', 'status' => '204'));

            $billing->delete();

            return response()->json($billing->toArray(), 202);
        } catch (Illuminate\Database\QueryException $e) {
            return response()->json(array('info' => 'Ha ocurrido un error con la base de datos'), 500);
        }
    }
}
