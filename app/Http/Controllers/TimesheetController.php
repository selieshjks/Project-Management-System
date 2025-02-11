<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Timesheet;

class TimesheetController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->query('filters', []);
        $timesheets = Timesheet::query();

        foreach ($filters as $field => $value) {
            $timesheets->where($field, $value);
        }

        return response()->json($timesheets->get());
    }

    public function show($id)
    {
        return Timesheet::findOrFail($id);
    }

    public function store(Request $request)
    {
        $request->validate([
            'task_name' => 'required|string',
            'date' => 'required|date',
            'hours' => 'required|integer',
            'project_id' => 'required|exists:projects,id',
            'user_id' => 'required|exists:users,id',
        ]);

        $timesheet = Timesheet::create($request->all());

        return response()->json($timesheet, 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'task_name' => 'sometimes|required|string',
            'date' => 'sometimes|required|date',
            'hours' => 'sometimes|required|integer',
            'project_id' => 'sometimes|required|exists:projects,id',
            'user_id' => 'sometimes|required|exists:users,id',
        ]);

        $timesheet = Timesheet::findOrFail($id);
        $timesheet->update($request->all());

        return response()->json($timesheet);
    }

    public function destroy($id)
    {
        $timesheet = Timesheet::findOrFail($id);
        $timesheet->delete();

        return response()->json(null, 204);
    }
}
