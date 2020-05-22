<?php

namespace App\Http\Controllers\API\Profile;

use App\Http\Requests\API\Profile\CreateUserAPIRequest;
use App\Http\Requests\API\Profile\UpdateUserAPIRequest;
use App\Models\Profile\User;
use App\Repositories\Profile\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class UserController
 * @package App\Http\Controllers\API\Profile
 */

class UserAPIController extends AppBaseController
{
    /** @var  UserRepository */
    private $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/users",
     *      summary="Get a listing of the Users.",
     *      tags={"User"},
     *      description="Get all Users",
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
     *                  @SWG\Items(ref="#/definitions/User")
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
            $users = $this->userRepository->all(
                $request->except(['skip', 'limit']),
                $request->get('skip'),
                $request->get('limit')
            );

            if ( ! empty($users) ) 
                return response()->json($users->toArray(), 200);

            return response()->json(array('info' => 'No se encontraron datos.', 'status' => '204'));
        } catch (Illuminate\Database\QueryException $e) {
            return response()->json(array('info' => 'Ha ocurrido un error con la base de datos'), 500);
        }
    }

    /**
     * @param CreateUserAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/users",
     *      summary="Store a newly created User in storage",
     *      tags={"User"},
     *      description="Store User",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="User that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/User")
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
     *                  ref="#/definitions/User"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateUserAPIRequest $request)
    {
        $input = $request->all();

        try { 
            $user = $this->userRepository->create($input);

            return response()->json($user->toArray(), 201);
        } catch (Illuminate\Database\QueryException $e) {
            return response()->json(array('info' => 'Ha ocurrido un error con la base de datos'), 500);
        }
    }

    /**
     * @param string $name
     * @return Response
     *
     * @SWG\Get(
     *      path="/users/{id}",
     *      summary="Display the specified User",
     *      tags={"User"},
     *      description="Get User",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="name",
     *          description="neme of User",
     *          type="string",
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
     *                  ref="#/definitions/User"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show(User $user)
    {
        try {
            /** @var User $user */
            $repository = $this->userRepository->relations($user->id);

            if ( empty($repository) ) 
                return response()->json(array('info' => 'Usuario no encontrado.', 'status' => '204'));

            return response()->json($repository->toArray(), 200);
        } catch (Illuminate\Database\QueryException $e) {
            return response()->json(array('info' => 'Ha ocurrido un error con la base de datos'), 500);
        }
    }

    /**
     * @param int $id
     * @param UpdateUserAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/users/{id}",
     *      summary="Update the specified User in storage",
     *      tags={"User"},
     *      description="Update User",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of User",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="User that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/User")
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
     *                  ref="#/definitions/User"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateUserAPIRequest $request)
    {
        $input = $request->all();
        
        try {
            /** @var User $user */
            $user = $this->userRepository->find($id);

            if (empty($user)) 
                return response()->json(array('info' => 'El cliente no puede ser actualizado.', 'status' => '204'));

            $user = $this->userRepository->update($input, $id);

            return response()->json($user->toArray(), 201);
        } catch (Illuminate\Database\QueryException $e) {
            return response()->json(array('info' => 'Ha ocurrido un error con la base de datos'), 500);
        }
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/users/{id}",
     *      summary="Remove the specified User from storage",
     *      tags={"User"},
     *      description="Delete User",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of User",
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
            /** @var User $user */
            $user = $this->userRepository->find($id);

            if ( empty($user) )
                return response()->json(array('info' => 'El usuario no puede ser eliminado.', 'status' => '204'));

            $user->delete();

            return response()->json($user->toArray(), 202);
        } catch (Illuminate\Database\QueryException $e) {
            return response()->json(array('info' => 'Ha ocurrido un error con la base de datos'), 500);
        }
    }
}
