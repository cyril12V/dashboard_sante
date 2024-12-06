<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SleepRecord;
use Illuminate\Support\Facades\Auth;

class SleepController extends Controller
{
    public function showDashboard()
    {
        $sleepRecords = SleepRecord::where('user_id', Auth::id())->get();
        $sleepDates = $sleepRecords->pluck('date');
        $sleepHours = $sleepRecords->pluck('hours_slept');

        return view('sleep.dashboard', compact('sleepRecords', 'sleepDates', 'sleepHours'));
    }

    public function create()
    {
        return view('sleep.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'hours_slept' => 'required|integer|min:1|max:24',
            'date' => 'required|date',
        ]);

        SleepRecord::create([
            'user_id' => Auth::id(),
            'hours_slept' => $request->hours_slept,
            'date' => $request->date,
        ]);

        return redirect()->route('sleep.dashboard')->with('success', 'Enregistrement de sommeil ajouté avec succès.');
    }

    public function edit($id)
    {
        $sleepRecord = SleepRecord::findOrFail($id);
        return view('sleep.edit', compact('sleepRecord'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'hours_slept' => 'required|integer|min:1|max:24',
            'date' => 'required|date',
        ]);

        $sleepRecord = SleepRecord::findOrFail($id);
        $sleepRecord->update($request->all());

        return redirect()->route('sleep.dashboard')->with('success', 'Enregistrement de sommeil mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $sleepRecord = SleepRecord::findOrFail($id);
        $sleepRecord->delete();

        return redirect()->route('sleep.dashboard')->with('success', 'Enregistrement de sommeil supprimé avec succès.');
    }
}
