<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Guide;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    // READ: list all, with optional search
    public function index(Request $request)
    {
        $query = Activity::with('guide');

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('name', 'like', "%$s%")
                  ->orWhere('location', 'like', "%$s%")
                  ->orWhere('code', 'like', "%$s%");
            });
        }

        $activities = $query->orderBy('activity_date')->get();
        return view('activities.index', compact('activities'));
    }

    // CREATE: show the form
    public function create()
    {
        $guides = Guide::all();
        return view('activities.create', compact('guides'));
    }

    // CREATE: save to the database
    public function store(Request $request)
    {
        $data = $request->validate([
            'code'          => 'required|max:10|unique:activities,code',
            'name'          => 'required|max:255',
            'location'      => 'required|max:255',
            'description'   => 'required',
            'price'         => 'required|numeric|min:0',
            'activity_date' => 'required|date',
            'difficulty'    => 'required|in:Easy,Moderate,Hard',
            'guide_id'      => 'nullable|exists:guides,guide_id',
        ]);

        Activity::create($data);

        return redirect()->route('activities.index')
                         ->with('success', 'Activity added successfully.');
    }

    // READ: one activity
    public function show(Activity $activity)
    {
        return view('activities.show', compact('activity'));
    }

    // UPDATE: show the form
    public function edit(Activity $activity)
    {
        $guides = Guide::all();
        return view('activities.edit', compact('activity', 'guides'));
    }

    // UPDATE: save changes
    public function update(Request $request, Activity $activity)
    {
        $data = $request->validate([
            'name'          => 'required|max:255',
            'location'      => 'required|max:255',
            'description'   => 'required',
            'price'         => 'required|numeric|min:0',
            'activity_date' => 'required|date',
            'difficulty'    => 'required|in:Easy,Moderate,Hard',
            'guide_id'      => 'nullable|exists:guides,guide_id',
        ]);

        $activity->update($data);

        return redirect()->route('activities.index')
                         ->with('success', 'Activity updated successfully.');
    }

    // DELETE
    public function destroy(Activity $activity)
    {
        $activity->delete();

        return redirect()->route('activities.index')
                         ->with('success', 'Activity deleted.');
    }
}