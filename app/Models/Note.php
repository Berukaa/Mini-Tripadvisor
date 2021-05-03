<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Note extends Model
{
    use HasFactory;
    use SoftDeletes;

        
    static function createDTOtoObject($request) {
        $note = new Note();

        $note->commentary = $request->commentary;
        $note->author = $request->author;
        $note->note = $request->note;

        return ($note);
    }

    static function updateDTOtoObject($request, $note) {
            if ($request->commentary)
                $note->commentary = $request->commentary;
            if ($request->author)
                $note->author = $request->author;
            if ($request->note)
                $note->note = $request->note;
            
            return ($note);
    }


}
