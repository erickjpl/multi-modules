<?php

namespace App\Http\Controllers\API\Billings;

use App\Http\Requests\API\Billings\CreateBillingDetailAPIRequest;
use App\Http\Requests\API\Billings\UpdateBillingDetailAPIRequest;
use App\Models\Billings\BillingDetail;
use App\Repositories\Billings\BillingDetailRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class BillingDetailController
 * @package App\Http\Controllers\API\Billings
 */

class BillingDetailAPIController extends AppBaseController
{
    /** @var  BillingDetailRepository */
    private $billingDetailRepository;

    public function __construct(BillingDetailRepository $billingDetailRepo)
    {
        $this->billingDetailRepository = $billingDetailRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/billingDetails",
     *      summary="Get a listing of the BillingDetails.",
     *      tags={"BillingDetail"},
     *      description="Get all BillingDetails",
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
     *                  @SWG\Items(ref="#/definitions/BillingDetail")
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
        $billingDetails = $this->billingDetailRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($billingDetails->toArray(), 'Billing Details retrieved successfully');
    }

    /**
     * @param CreateBillingDetailAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/billingDetails",
     *      summary="Store a newly created BillingDetail in storage",
     *      tags={"BillingDetail"},
     *      description="Store BillingDetail",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="BillingDetail that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/BillingDetail")
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
     *                  ref="#/definitions/BillingDetail"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateBillingDetailAPIRequest $request)
    {
        $input = $request->all();

        $billingDetail = $this->billingDetailRepository->create($input);

        return $this->sendResponse($billingDetail->toArray(), 'Billing Detail saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/billingDetails/{id}",
     *      summary="Display the specified BillingDetail",
     *      tags={"BillingDetail"},
     *      description="Get BillingDetail",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of BillingDetail",
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
     *                  ref="#/definitions/BillingDetail"
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
        /** @var BillingDetail $billingDetail */
        $billingDetail = $this->billingDetailRepository->find($id);

        if (empty($billingDetail)) {
            return $this->sendError('Billing Detail not found');
        }

        return $this->sendResponse($billingDetail->toArray(), 'Billing Detail retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateBillingDetailAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/billingDetails/{id}",
     *      summary="Update the specified BillingDetail in storage",
     *      tags={"BillingDetail"},
     *      description="Update BillingDetail",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of BillingDetail",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="BillingDetail that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/BillingDetail")
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
     *                  ref="#/definitions/BillingDetail"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateBillingDetailAPIRequest $request)
    {
        $input = $request->all();

        /** @var BillingDetail $billingDetail */
        $billingDetail = $this->billingDetailRepository->find($id);

        if (empty($billingDetail)) {
            return $this->sendError('Billing Detail not found');
        }

        $billingDetail = $this->billingDetailRepository->update($input, $id);

        return $this->sendResponse($billingDetail->toArray(), 'BillingDetail updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/billingDetails/{id}",
     *      summary="Remove the specified BillingDetail from storage",
     *      tags={"BillingDetail"},
     *      description="Delete BillingDetail",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of BillingDetail",
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
        /** @var BillingDetail $billingDetail */
        $billingDetail = $this->billingDetailRepository->find($id);

        if (empty($billingDetail)) {
            return $this->sendError('Billing Detail not found');
        }

        $billingDetail->delete();

        return $this->sendSuccess('Billing Detail deleted successfully');
    }
}
