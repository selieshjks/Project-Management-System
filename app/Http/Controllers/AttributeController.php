<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attribute;

class AttributeController extends Controller
{
    public function index()
    {
        return Attribute::all();
    }

    public function show($id)
    {
        return Attribute::findOrFail($id);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'type' => 'required|string|in:text,date,number,select',
        ]);

        $attribute = Attribute::create($request->all());

        return response()->json($attribute, 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'sometimes|required|string',
            'type' => 'sometimes|required|string|in:text,date,number,select',
        ]);

        $attribute = Attribute::findOrFail($id);
        $attribute->update($request->all());

        return response()->json($attribute);
    }

    public function destroy($id)
    {
        $attribute = Attribute::findOrFail($id);
        $attribute->delete();

        return response()->json(null, 204);
    }
}

