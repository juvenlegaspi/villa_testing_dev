<?php

namespace App\Http\Controllers;

use App\Models\Vessel;
use Illuminate\Http\Request;

class VesselController extends Controller
{
    public function index()
    {
        $vessels = Vessel::all();
        return view('shipping.vessels.index', compact('vessels'));
    }

    public function create()
    {
        return view('shipping.vessels.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'vessel_name' => 'required',
            'imo_number' => 'nullable',
            'call_sign' => 'nullable',
        ]);

        Vessel::create([
            'vessel_name' => $request->vessel_name,
            'imo_number' => $request->imo_number,
            'call_sign' => $request->call_sign,
        ]);

        return redirect('/shipping/vessels')->with('success', 'Vessel added successfully.');
    }
    public function show($id)
    {
        $vessel = Vessel::with('voyageLogs')->findOrFail($id);

        return view('shipping.vessels.show', compact('vessel'));
    }
}