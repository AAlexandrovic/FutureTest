<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * @OA\RequestBody(
 *    request="RegistrationRequest",
 *    description="Registration request body",
 *       @OA\JsonContent(
 *        type="object",
 *        required={"fio","phone","email"},
 *        @OA\Property(property="fio", type="string", example="Ivanov I.I."),
 *        @OA\Property(property="company", type="string", example="ExampleCo"),
 *        @OA\Property(property="phone", type="string", example="89991111111"),
 *        @OA\Property(property="email", type="string", example="example@mail.ru"),
 *        @OA\Property(property="birthdate", type="string", example="01.01.1990"),
 *        @OA\Property(property="image", type="string", example="photo.png"),
 *    )
 * )
 */

class Notebook extends Model
{
    use HasFactory;

    protected $table = "notebooks";

    protected $fillable = [
        'fio',
        'company',
        'phone',
        'email',
        'birthdate',
        'image'
    ];


    /**
     * @param array $attributes
     * @return Notebook
     */
    public function createNote(array $attributes): Notebook
    {
        $notebook = new self();
        $notebook->fio = $attributes["fio"];
        $notebook->company = $attributes["company"];
        $notebook->phone = $attributes["phone"];
        $notebook->email = $attributes["email"];
        $notebook->birthdate = $attributes["birthdate"];
        $notebook->image = $attributes["image"];
        $notebook->save();
        return $notebook;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getNote(int $id)
    {
        $note = $this->where("id", $id)->first();
        return $note;
    }

    /**
     * @return array
     */
    public function getsNote(): array
    {
        $todos = $this::all()->toArray();
        return $todos;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function deleteNote(int $id)
    {
        $note = $this->getNote($id);
        if ($note == null) {
            throw new ModelNotFoundException("Notes item not found");
        }
        return $note->delete();
    }
}
