<?php

namespace App\Http\Controllers;

use App\Models\TechDefect;
use App\Models\Vessel;
use Illuminate\Http\Request;
use App\Models\ThirdPartySupport;

class TechDefectController extends Controller
{

    public function index(Request $request)
    {
        $status = $request->status;
        $query = TechDefect::with('vessel')->latest();
        if($status){
            $query->where('status',$status);
        }
        $reports = $query->get();
        return view('shipping.tech_defects.index',compact('reports','status'));
    }
    public function create()
    {
        $vessels = Vessel::all();
        return view('shipping.tech_defects.create',compact('vessels'));
    }
    // create report of vessel
    public function store(Request $request)
    {
        $report = TechDefect::create($request->all());
        return redirect()->route('tech-defects.show', ['id' => $report->id])
        ->with('success','Report added');
    }

    public function edit($id)
    {
        $report = TechDefect::findOrFail($id);
        $vessels = Vessel::all();

        return view('shipping.tech_defects.edit',compact('report','vessels'));
    }

    public function update(Request $request, $id)
    {
        $report = TechDefect::findOrFail($id);
        // ADD THIRD PARTY SUPPORT
        if($request->action == 'add_support'){
            ThirdPartySupport::create([
                'tech_defect_id' => $id,
                'technician' => $request->technician,
                'spares_required' => $request->spares_required,
                'tools_required' => $request->tools_required,
                'status' => 'Pending'
            ]);
            return back()->with('success','3rd Party Support Added');
        }
        // COMPLETE REPORT
        if($request->action == 'complete'){
            $report->status = 'Completed';
            $report->save();
            return back()->with('success','Report Completed');
        }
        // MARK SUPPORT AS DONE
        if(str_starts_with($request->action,'done_')){
            $supportId = str_replace('done_','',$request->action);
            $support = ThirdPartySupport::findOrFail($supportId);
            $support->status = 'Done';
            $support->save();
            return back()->with('success','Support marked as done');
        }
    // UPDATE REPORT
        $data = $request->all();
        if($request->third_party_required == 'Yes'){
            $data['status'] = 'Waiting 3rd Party';
        }
        $report->update($data);
        return back()->with('success','Report Updated');
    }
    public function destroy($id)
    {
        TechDefect::findOrFail($id)->delete();

        return redirect()->route('tech-defects.index')
        ->with('success','Report deleted');
    }
    public function show($id)
    {
        $report = TechDefect::with('vessel','thirdParty')->findOrFail($id);
        $supports = ThirdPartySupport::where('tech_defect_id', $id)->get();
        $vessels = Vessel::all();
        return view('shipping.tech_defects.show', compact('report','supports'));
    }
    public function storeThirdParty(Request $request)
    {
        ThirdPartySupport::create([
            'tech_defect_id' => $request->tech_defect_id,
            'technician' => $request->technician,
            'spares_required' => $request->spares_required,
            'tools_required' => $request->tools_required,
            'status' => $request->status
        ]);
        return back()->with('success','Third party support saved');
    }
}
