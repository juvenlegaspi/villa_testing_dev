<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ThirdPartySupport;

class ThirdPartyController extends Controller
{

    public function store(Request $request,$id)
    {
        ThirdPartySupport::create([
            'tech_defect_id' => $id,
            'technician' => $request->technician,
            'spares_required' => $request->spares_required,
            'tools_required' => $request->tools_required,
            'status' => 'Pending'
        ]);
        return back()->with('success','3rd Party Support Saved');
    }

}