<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Research;


class ResearchController extends Controller
{
    public function create()
    {
        return view('research.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:researches',
        ]);

        Research::create([
            'name' => $request->name,
        ]);

        return redirect()->route('research.create')->with('success', 'Research added successfully.');
    }
}