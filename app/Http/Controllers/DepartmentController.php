<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    // Show all records
    public function index()
    {
        $departments = Department::all();
        return view('admin.departments.index', compact('departments'));
    }

    // Show form to create a new record
    public function create()
    {
        return view('admin.departments.create');
    }

    // Store a new record
    public function store(Request $request)
    {
        $request->validate([
            'department' => 'required|string|max:255',
            'year_level' => 'required|string|max:10',
            'section' => 'required|string|max:10',
        ]);

        Department::create($request->only('department', 'year_level', 'section'));

        return redirect()->route('admin.departments.index')->with('success', 'Department created successfully.');
    }

    // Show form to edit existing record
    public function edit(Department $department)
    {
        return view('admin.departments.edit', compact('department'));
    }

    // Update existing record
    public function update(Request $request, Department $department)
    {
        $request->validate([
            'department' => 'required|string|max:255',
            'year_level' => 'required|string|max:10',
            'section' => 'required|string|max:10',
        ]);

        $department->update($request->only('department', 'year_level', 'section'));

        return redirect()->route('admin.departments.index')->with('success', 'Department updated successfully.');
    }

    // Delete a record
    public function destroy(Department $department)
    {
        $department->delete();

        return redirect()->route('admin.departments.index')->with('success', 'Department deleted successfully.');
    }
}
