<?php

namespace App\Http\Controllers;

use App\Models\Guide;
use Illuminate\Http\Request;

class GuideController extends Controller
{
    // READ: list all guides, with optional search
    public function index(Request $request)
    {
        $query = Guide::withCount('activities');

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('name', 'like', "%$s%")
                  ->orWhere('phone', 'like', "%$s%")
                  ->orWhere('guide_id', 'like', "%$s%");
            });
        }

        $guides = $query->orderBy('guide_id')->get();
        return view('guides.index', compact('guides'));
    }

    // CREATE: show the form
    public function create()
    {
        return view('guides.create');
    }

    // CREATE: save to the database
    public function store(Request $request)
    {
        $data = $request->validate([
            'guide_id'         => 'required|max:10|unique:guides,guide_id',
            'name'             => 'required|max:255',
            'phone'            => 'required|max:20',
            'experience_years' => 'required|integer|min:0|max:60',
        ]);

        Guide::create($data);

        return redirect()->route('guides.index')
                         ->with('success', 'Guide added successfully.');
    }

    // UPDATE: show the form
    public function edit(Guide $guide)
    {
        return view('guides.edit', compact('guide'));
    }

    // UPDATE: save changes (the guide ID is the primary key, so it is not changed)
    public function update(Request $request, Guide $guide)
    {
        $data = $request->validate([
            'name'             => 'required|max:255',
            'phone'            => 'required|max:20',
            'experience_years' => 'required|integer|min:0|max:60',
        ]);

        $guide->update($data);

        return redirect()->route('guides.index')
                         ->with('success', 'Guide updated successfully.');
    }

    // DELETE (activities led by this guide become "Not assigned")
    public function destroy(Guide $guide)
    {
        $guide->delete();

        return redirect()->route('guides.index')
                         ->with('success', 'Guide deleted.');
    }
}
