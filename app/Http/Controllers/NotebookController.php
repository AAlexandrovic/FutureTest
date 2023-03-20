<?php

/**
 * @license Apache 2.0
 */

namespace App\Http\Controllers;

use App\Models\Notebook;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
     *     tags={"Add"},
     *      @OA\RequestBody(ref="#/components/requestBodies/RegistrationRequest"),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="id", type="number", example=1),
     *              @OA\Property(property="fio", type="string", example="Ivanov I.I"),
     *              @OA\Property(property="company", type="string", example="SuperCompany"),
     *              @OA\Property(property="phone", type="string", example="891611111111"),
     *              @OA\Property(property="email", type="string", example="example@email.ru"),
     *              @OA\Property(property="birthdate", type="string", example="01.01.1990"),
     *              @OA\Property(property="image", type="string", example="photo.png"),
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
     *
     *
     * @param Request $request
     * @return JsonResponse
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
     *     tags={"Select note"},
     *     summary=" Detail note from get",
     *     description = "Выборка методом  get",
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
     *
     * Get Detail  from post
     * @OA\Post  (
     *     path="/api/v1/notebook/{id}",
     *     tags={"Select note"},
     *     summary=" Detail note from post",
     *     description = "Выборка метедом post",
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
     *
     * @param int $id
     * @return JsonResponse
     */

    public function get(int $id): JsonResponse
    {
        $todo = $this->notebook->getNote($id);
        if ($todo) {
            return response()->json($todo);
        }
        return response()->json(["msg" => "Todo item not found"], 404);
    }

    /**
     * Show all notes from get
     * @OA\Get(
     *     path="/api/v1/notebook/gets",
     *     operationId="examplesAll",
     *     summary=" All notes from get",
     *     tags={"All notes"},
     *     description="Get",
     *        @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="The page number",
     *         required=true,
     *         explode=true,
     *         @OA\Schema(
     *             type="integer",
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Everything is fine",
     *         @OA\MediaType(
     *             mediaType="application/json"
     *         )
     *     ),
     * )
     *
     *
     *
     * Show all from post
     * @OA\Post (
     *     path="/api/v1/notebook/gets",
     *     operationId="examplesAllPost",
     *     summary=" All notes from post",
     *     tags={"All notes"},
     *     description="Post",
     *        @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="The page number",
     *         required=true,
     *         explode=true,
     *         @OA\Schema(
     *             type="integer",
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Everything is fine",
     *         @OA\MediaType(
     *             mediaType="application/json"
     *         )
     *     ),
     * )
     *
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */

    public function gets(): JsonResponse
    {
        // При запуске с удалённого сервера работает пагинация можно использовать этот скрипт
        //$paginate = Notebook::query()->paginate(10);
        // return response()->json($paginate);
        //При запуске  на localhost  c docker лучше использовать этот скрипт, часто не работает пагинация
        $model = $this->notebook->getsNote();
        $models = array_chunk($model, 10);
        $paginate = Notebook::query()->paginate(10);
        $lastPage = $paginate->lastPage();
        $number = explode('=', $_SERVER['REQUEST_URI']);
        if ($number[1] > $lastPage || $number[1] == 0) {
            return response()->json(['Запрашиваемой страницы не существует']);
        }
        array_unshift($models[$number[1] - 1], ['allPages' => $lastPage], ['thisPage' => (int)$number[1]]);
        return response()->json($models[$number[1] - 1]);
    }

    /**
     * Delete Note
     * @OA\Delete (
     *     path="/api/v1/delete/{id}",
     *     tags={"Delete"},
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
     *
     * @param int $id
     * @return JsonResponse
     */

    public function delete(int $id): JsonResponse
    {
        try {
            $todo = $this->notebook->deleteNote($id);
            return response()->json(["msg" => "delete todo success"]);
        } catch (ModelNotFoundException $exception) {
            return response()->json(["msg" => $exception->getMessage()], 404);
        }
    }

}
