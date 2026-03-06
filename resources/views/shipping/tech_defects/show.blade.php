@extends('layouts.app')

@section('content')

<div class="container">
    <h3 class="mb-1">Tech & Defect Report Details</h3>
        <form method="POST" action="{{ route('tech-defects.update',$report->id) }}">
            @csrf
            @method('PUT')
            <div class="mb-1 row">
                <div class="col-md-3 mb-1">
                    <label>Status</label>
                    <select name="status" class="form-control" value="{{$report->status}}" class="form-control" disabled>
                        <option value="Open" {{$report->status=='Open'?'selected':''}}> Open </option>
                        <option value="Ongoing" {{$report->status=='Ongoing'?'selected':''}}> Ongoing</option>
                        <option value="Waiting 3rd Party" {{$report->status=='Waiting 3rd Party'?'selected':''}}>Waiting 3rd Party</option>
                        <option value="Done" {{$report->status=='Done'?'selected':''}}>Done</option>
                        <option value="Complete" {{$report->status=='Completed'?'selected':''}}>Complete</option>
                    </select>
                </div>
                <div class="col-md-3 mb-1">
                    <label>Date Issue Identified</label>
                    <input type="date" name="date_identified" value="{{$report->date_identified}}" class="form-control" readonly>
                </div>
                <div class="col-md-3 mb-1">
                    <label>Vessel</label>
                    <input type="text" value="{{$report->vessel->vessel_name}}" class="form-control" readonly>
                </div>
            </div>
            <div class="mb-1 row">
                <div class="col-md-3 mb-1">
                    <label>Port / Location</label>
                    <input type="text" name="port_location" value="{{$report->port_location}}" class="form-control">
                </div>
                <div class="col-md-3 mb-1">
                    <label>Reported By</label>
                    <input type="text" name="reported_by" value="{{$report->reported_by}}" class="form-control">
                </div>
                <div class="col-md-3 mb-1">
                    <label>System Affected</label>
                    <input type="text" name="system_affected" value="{{$report->system_affected}}" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 mb-1">
                    <label>Severity Level</label>
                    <select name="severity_level" class="form-control">
                        <option value="Minor" {{$report->severity_level=='Minor'?'selected':''}}>Minor</option>
                        <option value="Major" {{$report->severity_level=='Major'?'selected':''}}>Major</option>
                        <option value="Critical" {{$report->severity_level=='Critical'?'selected':''}}>Critical</option>
                    </select>
                </div>
                <div class="col-md-3 mb-1">
                    <label>Operational Impact</label>
                    <input type="text" name="operational_impact" value="{{$report->operational_impact}}" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 mb-1">
                    <label>Defect Description</label>
                    <textarea name="defect_description" class="form-control">{{$report->defect_description}}</textarea>
                </div>
                <div class="col-md-3 mb-1">
                    <label>Initial Cause</label>
                    <textarea name="initial_cause" class="form-control">{{$report->initial_cause}}</textarea>
                </div>
                <div class="col-md-2 mb-3">
                    <label>Temporary Repair Done?</label>
                    <select name="temporary_repair" class="form-control">
                        <option value="Yes" {{$report->temporary_repair=='Yes'?'selected':''}}>Yes</option>
                        <option value="No" {{$report->temporary_repair=='No'?'selected':''}}>No</option>
                    </select>
                </div>
            </div>
            <div class="mb-1 row">
                <div class="col-md-3 mb-1">
                    <label>Remarks</label>
                    <textarea name="remarks" class="form-control">{{$report->remarks}}</textarea>
                </div>
                <div class="col-md-3 form-check mb-1">
                    <input type="checkbox" name="third_party_required" value="Yes" class="form-check-input" {{$report->third_party_required=='Yes'?'checked':''}}>
                    <label class="form-check-label">
                        Has Support
                    </label>
                </div>
            </div>
            @if($report->third_party_required == 'Yes')
                <hr style="border-top:1px solid black;">
                    @csrf
                    <div class="mb-1 row">
                        <div class="col-md-2 mb-1">
                            <label>Technician</label>
                            <input type="text" name="technician" class="form-control">
                        </div>
                        <div class="col-md-2 mb-1">
                            <label>Are spares required?</label>
                            <select name="spares_required" class="form-control">
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                        <div class="col-md-2 mb-1">
                            <label>Tools Required</label>
                            <input type="text" name="tools_required" class="form-control">
                        </div>
                        @if($report->status !=='Completed')
                        <div class="col-md-1 mb-1">
                            <label></label>
                            <button type="submit" name="action" value="add_support" class="btn btn-success form-control">Add</button>
                        </div>
                        @endif
                        <div>
                        @if(isset($supports) && $supports->count() > 0)
                            <hr>
                            <h5>Third Party Supports</h5>
                            <style>
                               <style>
.support-table th,
.support-table td{
    font-size:12px !important;
    padding:4px 6px !important;
    vertical-align: middle;
}

.support-table th{
    background:#f8f9fa;
    font-weight:600;
}
</style>
                            </style>
                            <table class="table table-bordered support-table">
                                <thead>
                                    <tr>
                                        <th>Technician</th>
                                        <th>Spares Required</th>
                                        <th>Tools Required</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($supports as $support)
                                    <tr>
                                        <td>{{ $support->technician }}</td>
                                        <td>{{ $support->spares_required }}</td>
                                        <td>{{ $support->tools_required }}</td>
                                        <td>{{ $support->status }}</td>
                                        @if($support->status != 'Done')
                                            <td>
                                                <button type="submit" name="action" value="done_{{ $support->id }}" class="btn btn-success btn-sm"> Done </button>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        @endif
                    </div>
            @endif
            <a href="{{route('tech-defects.index')}}" class="btn btn-secondary"> Back </a>
            @if($report->status !=='Completed')
            <button type="submit" name="action" value="update" class="btn btn-primary">Update</button>
            <button type="submit" name="action" value="complete" class="btn btn-success"> Complete </button>
            @endif
        </form>
</div>
@endsection