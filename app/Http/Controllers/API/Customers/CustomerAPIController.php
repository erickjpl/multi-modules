<?php

namespace App\Http\Controllers\API\Customers;

use App\Http\Requests\API\Customers\CreateCustomerAPIRequest;
use App\Http\Requests\API\Customers\UpdateCustomerAPIRequest;
use App\Models\Customers\Customer;
use App\Repositories\Customers\CustomerRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class CustomerController
 * @package App\Http\Controllers\API\Customers
 */

class CustomerAPIController extends AppBaseController
{
    /** @var  CustomerRepository */
    private $customerRepository;

    public function __construct(CustomerRepository $customerRepo)
    {
        $this->customerRepository = $customerRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/customers",
     *      summary="Get a listing of the Customers.",
     *      tags={"Customer"},
     *      description="Get all Customers",
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
     *                  @SWG\Items(ref="#/definitions/Customer")
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
            $customers = $this->customerRepository->all(
                $request->except(['skip', 'limit']),
                $request->get('skip'),
                $request->get('limit')
            );

            if ( ! empty($customers) ) 
                return response()->json($customers->toArray(), 200);

            return response()->json(array('info' => 'No se encontraron datos.', 'status' => '204'));
        } catch (Illuminate\Database\QueryException $e) {
            return response()->json(array('info' => 'Ha ocurrido un error con la base de datos'), 500);
        }
    }

    /**
     * @param CreateCustomerAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/customers",
     *      summary="Store a newly created Customer in storage",
     *      tags={"Customer"},
     *      description="Store Customer",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Customer that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Customer")
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
     *                  ref="#/definitions/Customer"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateCustomerAPIRequest $request)
    {
        $input = $request->all();
        
        try {
            $customer = $this->customerRepository->create($input);

            return response()->json($customer->toArray(), 201);
        } catch (Illuminate\Database\QueryException $e) {
            return response()->json(array('info' => 'Ha ocurrido un error con la base de datos'), 500);
        }
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/customers/{id}",
     *      summary="Display the specified Customer",
     *      tags={"Customer"},
     *      description="Get Customer",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Customer",
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
     *                  ref="#/definitions/Customer"
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
            /** @var Customer $customer */
            $customer = $this->customerRepository->find($id);
                
            if ( empty($customer) ) 
                return response()->json(array('info' => 'Cliente no encontrado.', 'status' => '204'));

            return response()->json($customer->toArray(), 200);
        } catch (Illuminate\Database\QueryException $e) {
            return response()->json(array('info' => 'Ha ocurrido un error con la base de datos'), 500);
        }
    }

    /**
     * @param int $id
     * @param UpdateCustomerAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/customers/{id}",
     *      summary="Update the specified Customer in storage",
     *      tags={"Customer"},
     *      description="Update Customer",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Customer",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Customer that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Customer")
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
     *                  ref="#/definitions/Customer"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateCustomerAPIRequest $request)
    {
        $input = $request->all();
        
        try {
            /** @var Customer $customer */
            $customer = $this->customerRepository->find($id);

            if (empty($customer))
                return response()->json(array('info' => 'El cliente no puede ser actualizado.', 'status' => '204'));

            $customer = $this->customerRepository->update($input, $id);

            return response()->json($customer->toArray(), 201);
        } catch (Illuminate\Database\QueryException $e) {
            return response()->json(array('info' => 'Ha ocurrido un error con la base de datos'), 500);
        }
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/customers/{id}",
     *      summary="Remove the specified Customer from storage",
     *      tags={"Customer"},
     *      description="Delete Customer",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Customer",
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
            /** @var Customer $customer */
            $customer = $this->customerRepository->find($id);

            if (empty($customer))
                return response()->json(array('info' => 'El cliente no puede ser eliminado.', 'status' => '204'));

            $customer->delete();

            return response()->json($product->toArray(), 202);
        } catch (Illuminate\Database\QueryException $e) {
            return response()->json(array('info' => 'Ha ocurrido un error con la base de datos'), 500);
        }
    }
}
