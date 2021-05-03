<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Box extends Model
{
    protected $table = 'boxes';
    use HasFactory;
    use SoftDeletes;

        
    static function createDTOtoObject($request) {
        $boxes = new Box();

        $boxes->name = $request->name;
        $boxes->address = $request->address;
        $boxes->city = $request->city;
        $boxes->postal = $request->postal;
        $boxes->country = $request->country;

        return ($boxes);
    }

    static function updateDTOtoObject($request, $boxes) {
            if ($request->name)
                $boxes->name = $request->name;
            if ($request->address)
                $boxes->address = $request->address;
            if ($request->city)
                $boxes->city = $request->city;
            if ($request->postal)
                $boxes->postal = $request->postal;
            if ($request->country)
                $boxes->country = $request->country;
            
            return ($boxes);
    }


}
