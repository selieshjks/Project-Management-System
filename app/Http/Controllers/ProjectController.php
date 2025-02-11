<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\AttributeValue;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->query('filters', []);
        $projects = Project::query();

        foreach ($filters as $field => $value) {
            $projects->where($field, $value);
        }

        return response()->json($projects->get());
    }

    public function show($id)
    {
        return Project::with('attributeValues.attribute')->findOrFail($id);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'status' => 'required|string',
            'attributes' => 'array'
        ]);

        $project = Project::create($request->only(['name', 'status']));

        if ($request->has('attributes')) {
            foreach ($request->input("attributes") as $attributeId => $value) {
                AttributeValue::create([
                    'attribute_id' => $attributeId,
                    'entity_id' => $project->id,
                    'value' => $value
                ]);
            }
        }

        return response()->json($project, 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'sometimes|required|string',
            'status' => 'sometimes|required|string',
            'attributes' => 'array'
        ]);

        $project = Project::findOrFail($id);
        $project->update($request->only(['name', 'status']));

        if ($request->has('attributes')) {
            foreach ($request->input("attributes") as $attributeId => $value) {
                $attributeValue = AttributeValue::firstOrNew([
                    'attribute_id' => $attributeId,
                    'entity_id' => $project->id,
                ]);
                $attributeValue->value = $value;
                $attributeValue->save();
            }
        }

        return response()->json($project);
    }

    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();

        return response()->json(null, 204);
    }
}

