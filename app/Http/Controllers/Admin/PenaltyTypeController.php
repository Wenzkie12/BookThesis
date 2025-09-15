<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PenaltyType;
use Illuminate\Http\Request;

class PenaltyTypeController extends Controller
{
    public function index()
    {
        $penaltyTypes = PenaltyType::all();
        return view('admin.penaltytype.index', compact('penaltyTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
        ]);

        PenaltyType::create($request->only('name', 'amount'));

        return redirect()->route('admin.penaltytype.index')->with('success', 'Penalty type added.');
    }

    public function edit(PenaltyType $penaltyType)
    {
        return view('admin.penaltytype.edit', compact('penaltyType'));
    }

    public function update(Request $request, PenaltyType $penaltyType)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
        ]);

        $penaltyType->update($request->only('name', 'amount'));

        return redirect()->route('admin.penaltytype.index')->with('success', 'Penalty type updated.');
    }

    public function destroy(PenaltyType $penaltyType)
    {
        $penaltyType->delete();
        return redirect()->route('admin.penaltytype.index')->with('success', 'Penalty type deleted.');
    }
}
