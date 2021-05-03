<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Note;

class NoteController extends Controller
{
    public function getAll()
    {
        return Note::all();
    }

    public function getByID($id)
    {
        return Note::findOrFail($id);
    }
    
    #Créer un commentaire dans la bdd
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'commentary' => 'required',
            'author' => 'required',
            'note' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => "A field is missing"
            ], 400);
        } else {
            $note = Note::createDTOtoObject($request);

            $note->save();

            return response($note, 201);
        }
    }

    #Modifier un commentaire dans la bdd
    public function update(Request $request, $id)
    {
        $note = Note::findOrFail($id);

        if ($note) {
            $note = Note::updateDTOtoObject($request, $note);
            $note->save();

            return response($note, 200);
        } else {
            return response()->json([
                'message' => "Note doesn't exist."
            ], 400);
        }
    }

    #Supprime un commentaire dans la bdd
    public function delete(Request $request, $id)
    {
        $note = Note::findOrFail($id);

        if ($note) {
            $note->delete();
        } else {
            return response()->json([
                'message' => "Note doesn't exist."
            ], 400);
        }
    }
}