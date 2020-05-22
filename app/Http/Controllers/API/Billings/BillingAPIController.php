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
        $billings = $this->billingRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($billings->toArray(), 'Billings retrieved successfully');
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

        $billing = $this->billingRepository->create($input);

        return $this->sendResponse($billing->toArray(), 'Billing saved successfully');
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
    public function show($id)
    {
        /** @var Billing $billing */
        $billing = $this->billingRepository->find($id);

        if (empty($billing)) {
            return $this->sendError('Billing not found');
        }

        return $this->sendResponse($billing->toArray(), 'Billing retrieved successfully');
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

        /** @var Billing $billing */
        $billing = $this->billingRepository->find($id);

        if (empty($billing)) {
            return $this->sendError('Billing not found');
        }

        $billing = $this->billingRepository->update($input, $id);

        return $this->sendResponse($billing->toArray(), 'Billing updated successfully');
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
        /** @var Billing $billing */
        $billing = $this->billingRepository->find($id);

        if (empty($billing)) {
            return $this->sendError('Billing not found');
        }

        $billing->delete();

        return $this->sendSuccess('Billing deleted successfully');
    }
}
