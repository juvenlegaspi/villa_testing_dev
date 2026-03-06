<?php

namespace App\Http\Controllers;

use App\Models\Vessel;
use App\Models\VoyageLog;

class DashboardController extends Controller
{
    public function index()
    {
        $totalVessels = Vessel::count();

        $totalLogs = VoyageLog::count();

        $anchored = VoyageLog::where('voyage_status', 'anchored')->count();

        $sailing = VoyageLog::where('voyage_status', 'sailing')->count();

        $totalCrew = VoyageLog::sum('crew_on_board');

        return view('dashboard', compact(
            'totalVessels',
            'totalLogs',
            'anchored',
            'sailing',
            'totalCrew'
        ));
    }
}
