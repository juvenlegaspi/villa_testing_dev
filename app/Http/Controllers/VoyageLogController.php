<?php

namespace App\Http\Controllers;

use App\Models\Vessel;
use App\Models\VoyageLog;
use Illuminate\Http\Request;

class VoyageLogController extends Controller
{
    public function create($id)
    {
        $vessel = Vessel::findOrFail($id);
        return view('shipping.voyage_logs.create', compact('vessel'));
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'date_started' => 'nullable|date',
            'port_location' => 'nullable',
            'voyage_number' => 'nullable',
        ]);

        VoyageLog::create([
            'vessel_id' => $id,
            'date_started' => $request->date_started,
            'date_completed' => $request->date_completed,
            'port_location' => $request->port_location,
            'voyage_number' => $request->voyage_number,
            'fuel_rob' => $request->fuel_rob,
            'cargo_type' => $request->cargo_type,
            'cargo_volume' => $request->cargo_volume,
            'crew_on_board' => $request->crew_on_board,
            'voyage_status' => $request->voyage_status,
            'activity' => $request->activity,
            'time_started' => $request->time_started,
            'time_finished' => $request->time_finished,
            'total_hrs' => $request->total_hrs,
            'remarks' => $request->remarks,
        ]);

        return redirect('/shipping/vessels/'.$id)
            ->with('success', 'Voyage log added successfully.');
    }
    public function edit($vesselId, $logId)
    {
        $vessel = Vessel::findOrFail($vesselId);
        $log = VoyageLog::findOrFail($logId);

        return view('shipping.voyage_logs.edit', compact('vessel', 'log'));
    }

    public function update(Request $request, $vesselId, $logId)
    {
        $log = VoyageLog::findOrFail($logId);

        $request->validate([
            'date_started' => 'nullable|date',
        ]);

        $log->update($request->all());

        return redirect('/shipping/vessels/'.$vesselId)
            ->with('success', 'Voyage log updated successfully.');
    }
    public function destroy($vesselId, $logId)
    {
        $log = VoyageLog::findOrFail($logId);
        $log->delete();

        return redirect('/shipping/vessels/'.$vesselId)
        ->with('success', 'Voyage log deleted.');
    }
}