<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AttributeValue;

class AttributeValueController extends Controller
{
    public function index()
    {
        return AttributeValue::all();
    }

    public function show($id)
    {
        return AttributeValue::findOrFail($id);
    }

    public function store(Request $request)
    {
        $request->validate([
            'attribute_id' => 'required|exists:attributes,id',
            'entity_id' => 'required|exists:projects,id',
            'value' => 'required|string',
        ]);

        $attributeValue = AttributeValue::create($request->all());

        return response()->json($attributeValue, 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'attribute_id' => 'sometimes|required|exists:attributes,id',
            'entity_id' => 'sometimes|required|exists:projects,id',
            'value' => 'sometimes|required|string',
        ]);

        $attributeValue = AttributeValue::findOrFail($id);
        $attributeValue->update($request->all());

        return response()->json($attributeValue);
    }

    public function destroy($id)
    {
        $attributeValue = AttributeValue::findOrFail($id);
        $attributeValue->delete();

        return response()->json(null, 204);
    }
}