<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    public function showDashboard()
    {
        $activities = Activity::where('user_id', Auth::id())->get();
        $activityDates = $activities->pluck('date');
        $activityDurations = $activities->pluck('duration');

        return view('activities.dashboard', compact('activities', 'activityDates', 'activityDurations'));
    }

    public function create()
    {
        return view('activities.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'activity_type' => 'required|string|max:255',
            'duration' => 'required|integer|min:1',
            'date' => 'required|date',
        ]);

        Activity::create([
            'user_id' => Auth::id(),
            'activity_type' => $request->activity_type,
            'duration' => $request->duration,
            'date' => $request->date,
        ]);

        return redirect()->route('activities.dashboard')->with('success', 'Activité ajoutée avec succès.');
    }

    public function edit($id)
    {
        $activity = Activity::findOrFail($id);
        return view('activities.edit', compact('activity'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'activity_type' => 'required|string|max:255',
            'duration' => 'required|integer|min:1',
            'date' => 'required|date',
        ]);

        $activity = Activity::findOrFail($id);
        $activity->update($request->all());

        return redirect()->route('activities.dashboard')->with('success', 'Activité mise à jour avec succès.');
    }

    public function destroy($id)
    {
        $activity = Activity::findOrFail($id);
        $activity->delete();

        return redirect()->route('activities.dashboard')->with('success', 'Activité supprimée avec succès.');
    }
}
