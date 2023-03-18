<?php

namespace App\Http\Controllers;

use App\Models\Notebook;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class NotebookController extends Controller
{
    protected $notebook;

    public function __construct(Notebook $notebook)
    {
        $this->notebook = $notebook;
    }


    /**
     * Create Note
     * @OA\Post (
     *     path="/api/v1/notebook/store",
     *     tags={"Notes"},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                      type="object",
     *                      @OA\Property(
     *                          property="fio",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="company",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="phone",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="email",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="birthdate",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="image",
     *                          type="string"
     *                      ),
     *                 ),
     *                 example={
     *                     "fio":"Ivanov I.I.",
     *                     "company":"BBC",
     *                     "phone":"89999876543210",
     *                     "email":"email@mail.ru",
     *                     "birthdate":"1990",
     *                     "image": 0
     *                }
     *             )
     *         )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="id", type="number", example=1),
     *              @OA\Property(property="fio", type="string", example="fio"),
     *              @OA\Property(property="company", type="string", example="company"),
     *              @OA\Property(property="phone", type="string", example="phone"),
     *              @OA\Property(property="email", type="string", example="email"),
     *              @OA\Property(property="birthdate", type="string", example="birthdate"),
     *              @OA\Property(property="updated_at", type="string", example="2021-12-11T09:25:53.000000Z"),
     *              @OA\Property(property="created_at", type="string", example="2021-12-11T09:25:53.000000Z"),
     *          )
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="invalid",
     *          @OA\JsonContent(
     *              @OA\Property(property="msg", type="string", example="fail"),
     *          )
     *      )
     * )
     */
    public function store(Request $request): JsonResponse
    {
        $todo = $this->notebook->createNote($request->all());
        return response()->json($todo);
    }

    /**
     * Get Detail Notes
     * @OA\Get (
     *     path="/api/v1/notebook/{id}",
     *     tags={"Notes"},
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="success",
     *         @OA\JsonContent(
     *              @OA\Property(property="id", type="number", example=1),
     *              @OA\Property(property="fio", type="string", example="fio"),
     *              @OA\Property(property="company", type="string", example="company"),
     *              @OA\Property(property="phone", type="string", example="phone"),
     *              @OA\Property(property="email", type="string", example="email"),
     *              @OA\Property(property="birthdate", type="string", example="birthdate"),
     *              @OA\Property(property="updated_at", type="string", example="2021-12-11T09:25:53.000000Z"),
     *              @OA\Property(property="created_at", type="string", example="2021-12-11T09:25:53.000000Z"),
     *         )
     *     )
     * )
     */
    public function get($id): JsonResponse
    {
        $todo = $this->notebook->getNote($id);
        if ($todo) {
            return response()->json($todo);
        }
        return response()->json(["msg" => "Todo item not found"], 404);
    }

    /**
     * test
     * @OA\Get(
     *     path="/api/v1/notebook/gets",
     *     operationId="examplesAll",
     *     summary=" all notes",
     *     tags={"All notes"},
     *     description="Get",
     *     security={
     *       {"api_key": {}},
     *        },
     *           @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="The page number",
     *         required=false,
     *         @OA\Schema(
     *             type="integer",
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\MediaType(
     *              mediaType="application/json"
     *          )
     *     )
     * )
     *
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function gets(): JsonResponse
    {
        $model = Notebook::query()->paginate(2);
        return response()->json($model);
        //$todos = $this->notebook->getsNote();
        //return response()->json(["rows" => $todos]);
    }

    /**
     * Delete Note
     * @OA\Delete (
     *     path="/api/v1/delete/{id}",
     *     tags={"Note"},
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="success",
     *         @OA\JsonContent(
     *             @OA\Property(property="msg", type="string", example="delete todo success")
     *         )
     *     )
     * )
     */
    public function delete($id): JsonResponse
    {
        try {
            $todo = $this->notebook->deleteNote($id);
            return response()->json(["msg" => "delete todo success"]);
        } catch (ModelNotFoundException $exception) {
            return response()->json(["msg" => $exception->getMessage()], 404);
        }
    }

}
