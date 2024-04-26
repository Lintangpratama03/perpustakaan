<?php

namespace App\Http\Controllers;

use App\Models\Data;
use App\Http\Resources\DataResource;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'sensor' => 'required|string',
            'value' => 'required',
        ]);

        $newData = Data::create($validatedData);

        return new DataResource($newData);
    }
}
