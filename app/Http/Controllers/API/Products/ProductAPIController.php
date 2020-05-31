<?php

namespace App\Http\Controllers\API\Products;

use App\Http\Requests\API\Products\CreateProductAPIRequest;
use App\Http\Requests\API\Products\UpdateProductAPIRequest;
use App\Models\Products\Product;
use App\Repositories\Products\ProductRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ProductController
 * @package App\Http\Controllers\API\Products
 */

class ProductAPIController extends AppBaseController
{
    /** @var  ProductRepository */
    private $productRepository;

    public function __construct(ProductRepository $productRepo)
    {
        $this->productRepository = $productRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/products",
     *      summary="Get a listing of the Products.",
     *      tags={"Product"},
     *      description="Get all Products",
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
     *                  @SWG\Items(ref="#/definitions/Product")
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
            $products = $this->productRepository->allProducts(
                $request->except(['skip', 'limit']),
                $request->get('skip'),
                $request->get('limit')
            );
           
            if ( ! empty($products) ) 
                return response()->json($products->toArray(), 200);

            return response()->json(array('info' => 'No se encontraron datos.', 'status' => '204'));
        } catch (Illuminate\Database\QueryException $e) {
            return response()->json(array('info' => 'Ha ocurrido un error con la base de datos'), 500);
        }
    }

    /**
     * @param CreateProductAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/products",
     *      summary="Store a newly created Product in storage",
     *      tags={"Product"},
     *      description="Store Product",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Product that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Product")
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
     *                  ref="#/definitions/Product"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateProductAPIRequest $request)
    {
        $input = $request->all();
        
        try{
            $product = $this->productRepository->create($input);

            return response()->json($product->toArray(), 201);
        } catch (Illuminate\Database\QueryException $e) {
            return response()->json(array('info' => 'Ha ocurrido un error con la base de datos'), 500);
        }
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/products/{id}",
     *      summary="Display the specified Product",
     *      tags={"Product"},
     *      description="Get Product",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Product",
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
     *                  ref="#/definitions/Product"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show(Request $request, Product $product)
    {
        try {
            /** @var Product $product */
            $repository = $this->productRepository->relations($request)->find($product->id);
            
            if ( empty($repository) ) 
                return response()->json(array('info' => 'Producto no encontrado.', 'status' => '204'));

            return response()->json($repository->toArray(), 200);
        } catch (Illuminate\Database\QueryException $e) {
            return response()->json(array('info' => 'Ha ocurrido un error con la base de datos'), 500);
        }
    }

    /**
     * @param int $id
     * @param UpdateProductAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/products/{id}",
     *      summary="Update the specified Product in storage",
     *      tags={"Product"},
     *      description="Update Product",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Product",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Product that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Product")
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
     *                  ref="#/definitions/Product"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update(Product $product, UpdateProductAPIRequest $request)
    {
        try{
            $input = $request->all();

            /** @var Product $product */
            $repository = $this->productRepository->find($product->id);

            if ( empty($repository) )
                return response()->json(array('info' => 'El producto no puede ser actualizado.', 'status' => '204'));

            $repository = $this->productRepository->update($input, $product->id);

            return response()->json($repository->toArray(), 201);
        } catch (Illuminate\Database\QueryException $e) {
            return response()->json(array('info' => 'Ha ocurrido un error con la base de datos'), 500);
        }
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/products/{id}",
     *      summary="Remove the specified Product from storage",
     *      tags={"Product"},
     *      description="Delete Product",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Product",
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
    public function destroy(Product $product)
    {
        try {
            /** @var Product $product */
            $repository = $this->productRepository->find($product->id);

            if ( empty($repository) ) 
                return response()->json(array('info' => 'El producto no puede ser eliminado.', 'status' => '204'));

            $repository->delete();

            return response()->json($repository->toArray(), 202);
        } catch (Illuminate\Database\QueryException $e) {
            return response()->json(array('info' => 'Ha ocurrido un error con la base de datos'), 500);
        }
    }
}
