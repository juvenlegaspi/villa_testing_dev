@extends('layouts.app')
@section('content')
<div class="container">
    <h4 class="mb-3">Add Tech & Defect Report</h4>
    <form method="POST" action="{{route('tech-defects.store')}}">
        @csrf
        <div class="row">
            <div class="col-md-4 mb-3">
                <label>Status</label>
                    <select name="status" class="form-control" value="">
                        <option value="Open">Open</option>
                        <option value="Ongoing">On Going</option>
                        <option value="Complete">Completed</option>
                    </select>
            </div>
            <div class="col-md-4 mb-3">
                <label>Date Issue Identified</label>
                <input type="date" name="date_identified" class="form-control" required>
            </div>
            <div class="col-md-4 mb-3">
                <label>Vessel</label>
                <select name="vessel_id" class="form-control">
                    @foreach($vessels as $v)
                        <option value="{{$v->id}}">{{$v->vessel_name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label>Port / Location</label>
                <input type="text" name="port_location" value="" class="form-control">
            </div>
            <div class="col-md-4 mb-3">
                <label>Reported By</label>
                <input type="text" name="reported_by" value="" class="form-control">
            </div>
            <div class="col-md-4 mb-3">
                <label>System Affected</label>
                <input type="text" name="system_affected" class="form-control">
            </div>
            <div class="col-md-6 mb-3">
                <label>Severity Level</label>
                    <select name="severity_level" class="form-control">
                        <option>Minor</option>
                        <option>Major</option>
                        <option>Critical</option>
                    </select>
            </div>
            <div class="col-md-6 mb-3">
                <label>Operational Impact</label>
                <select name="operational_impact" class="form-control">
                    <option>None</option>
                    <option>Limited</option>
                    <option>Stopped</option>
                </select>
            </div>
            <div class="col-md-12 mb-3">
                <label>Defect Description</label>
                <textarea name="defect_description" class="form-control"></textarea>
            </div>
            <div class="col-md-12 mb-3">
                <label>Initial Cause</label>
                <textarea name="initial_cause" class="form-control"></textarea>
            </div>
            <div class="col-md-12 mb-3">
                <label>Temporary Repair Done?</label>
                <select name="temporary_repair" class="form-control">
                    <option>Yes</option>
                    <option>No</option>
                </select>
            </div>
            <div class="col-md-12 mb-3">
                <label>Remarks</label>
                <textarea name="remarks" class="form-control"></textarea>
            </div>
        </div>
        <button class="btn btn-success">Save Report</button>
            <a href="{{route('tech-defects.index')}}" class="btn btn-secondary"> Back </a>
    </form>
</div>
@endsection