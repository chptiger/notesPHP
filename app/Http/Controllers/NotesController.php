<?php

namespace App\Http\Controllers;

use App\Note;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Exception;

/**
 * Class NotesController
 * @package App\http\controllers
 */

class NotesController extends Controller
{
    /**
     * GET /notes
     * @return array
     */
    public function index()
    {
        try{
            return Note::all();
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

    }

    /**
     * GET /notes/{id}
     * @return mixed
     */
    public function show($id)
    {
        try {
            return  Note::findOrFail($id);
        } catch (\Exception $e) {
            return response()->json([
                'error' => [
                    'message' => 'Note not found'
                ]], 404);
        }
    }


    /**
     * POST /notes
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function store(Request $request) {
        $this->validate($request, [
            'user_id' => 'required',
            'title'=> 'required|max:50',
            'note'=> 'required|max:1000'
        ]);

        try {
            $note = Note::create($request->all());
        } catch (\Exception $e) {
//            dd(get_class($e));
            dd($e->getMessage());
        }
        return response()->json(['created' => true], 201);
    }

    /**
     * PUT /notes/{id}
     *
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function update(Request $request, $id) {
        try {
            $note = Note::findOrFail($id);
        } catch (\Exception $e) {
            return response()->json([
            'error' => [
                'message' => 'Note not found'
            ] ], 404);
        }

        $note->fill($request->all());
        $note->save();

        return $note;
    }

    /**
     * DELETE /notes/{id}
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id) {
        try {
            $note = Note::findOrFail($id);
        } catch (\Exception $e) {
            return response()->json([
            'error' => [
                'message' => 'Note not found'
            ] ], 404);
        }
        $note->delete();
        return response(null, 204);
    }
}