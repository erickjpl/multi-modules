<?php

namespace App\Http\Controllers\API\Products\Config;

use App\Http\Requests\API\Products\Config\CreateCategoryAPIRequest;
use App\Http\Requests\API\Products\Config\UpdateCategoryAPIRequest;
use App\Models\Products\Config\Category;
use App\Repositories\Products\Config\CategoryRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class CategoryController
 * @package App\Http\Controllers\API\Products\Config
 */

class CategoryAPIController extends AppBaseController
{
    /** @var  CategoryRepository */
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepo)
    {
        $this->categoryRepository = $categoryRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/categories",
     *      summary="Get a listing of the Categories.",
     *      tags={"Category"},
     *      description="Get all Categories",
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
     *                  @SWG\Items(ref="#/definitions/Category")
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
            $categories = $this->categoryRepository->relations()->all(
                $request->except(['skip', 'limit']),
                $request->get('skip'),
                $request->get('limit')
            );

            if ( ! empty($categories) ) 
                return response()->json($categories, 200);

            return response()->json(array('info' => 'No se encontraron datos.', 'status' => '204'));
        } catch (Illuminate\Database\QueryException $e) {
            return response()->json(array('info' => 'Ha ocurrido un error con la base de datos'), 500);
        }
    }

    /**
     * @param CreateCategoryAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/categories",
     *      summary="Store a newly created Category in storage",
     *      tags={"Category"},
     *      description="Store Category",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Category that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Category")
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
     *                  ref="#/definitions/Category"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateCategoryAPIRequest $request)
    {
        $input = $request->all();

        try {
            $category = $this->categoryRepository->create($input);

            return response()->json($category->toArray(), 201);
        } catch (Illuminate\Database\QueryException $e) {
            return response()->json(array('info' => 'Ha ocurrido un error con la base de datos'), 500);
        }
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/categories/{id}",
     *      summary="Display the specified Category",
     *      tags={"Category"},
     *      description="Get Category",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Category",
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
     *                  ref="#/definitions/Category"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show(Category $category)
    {
        try {
            /** @var Category $category */
            $repository = $this->categoryRepository->relations()->find($category->id);

            if ( empty($repository) ) 
                return response()->json(array('info' => 'Categoria no encontrada.', 'status' => '204'));

            return response()->json($repository->toArray(), 200);
        } catch (Illuminate\Database\QueryException $e) {
            return response()->json(array('info' => 'Ha ocurrido un error con la base de datos'), 500);
        }
    }

    /**
     * @param int $id
     * @param UpdateCategoryAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/categories/{id}",
     *      summary="Update the specified Category in storage",
     *      tags={"Category"},
     *      description="Update Category",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Category",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Category that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Category")
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
     *                  ref="#/definitions/Category"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update(Category $category, UpdateCategoryAPIRequest $request)
    {
        $input = $request->all();

        try {
            /** @var Category $category */
            $repository = $this->categoryRepository->find($category->id);

            if ( empty($repository) ) 
                return response()->json(array('info' => 'La categoria no puede ser actualizada.', 'status' => '204'));

            $repository = $this->categoryRepository->update($input, $category->id);

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
     *      path="/categories/{id}",
     *      summary="Remove the specified Category from storage",
     *      tags={"Category"},
     *      description="Delete Category",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Category",
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
    public function destroy(Category $category)
    {
        try {
            /** @var Category $category */
            $repository = $this->categoryRepository->find($category->id);

            if ( empty($repository) ) 
                return response()->json(array('info' => 'La categoria no puede ser eliminada.', 'status' => '204'));

            $repository->delete();

            return response()->json($repository->toArray(), 202);
        } catch (Illuminate\Database\QueryException $e) {
            return response()->json(array('info' => 'Ha ocurrido un error con la base de datos'), 500);
        }
    }
}
