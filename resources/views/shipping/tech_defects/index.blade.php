@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-3">

        <h4>Tech & Defect Reports</h4>

        <a href="{{route('tech-defects.create')}}" class="btn btn-primary">
            + Add Report
        </a>
    </div>
    <form method="GET" class="mb-3">
        <select name="status" class="form-control w-25" onchange="this.form.submit()">
            <option value="">All Status</option>
            <option value="OPEN">Open</option>
            <option value="ONGOING">On Going</option>
            <option value="COMPLETED">Completed</option>
        </select>
    </form>
    <table class="table table-bordered">
    <thead class="table-light">
        <tr>
            <th>ID</th>
            <th>Status</th>
            <th>Date Identified</th>
            <th>Vessel</th>
            <th>Port</th>
            <th>System</th>
            <th>Defect Description</th>
            <th>Severity</th>
        </tr>
    </thead>
        <tbody>
            @foreach($reports as $r)
                <tr>
                    <td>
                        <a href="{{route('tech-defects.show',$r->id)}}"> TD-{{$r->id}} </a>
                    </td>
                    <td>
                        @if($r->status == 'Open')
                            <span class="badge bg-danger">Open</span>
                        @elseif($r->status == 'Ongoing')
                            <span class="badge bg-primary">Ongoing</span>
                        @elseif($r->status == 'Waiting 3rd Party')
                            <span class="badge bg-warning text-dark">Waiting 3rd Party</span>
                        @elseif($r->status == 'Done')
                            <span class="badge bg-secondary">Done</span>
                        @elseif($r->status == 'Completed')
                            <span class="badge bg-success">Complete</span>
                        @endif
                    </td>
                    <td>{{$r->date_identified}}</td>
                    <td>{{$r->vessel->vessel_name ?? ''}}</td>
                    <td>{{$r->port_location}}</td>
                    <td>{{$r->system_affected}}</td>
                    <td>{{$r->defect_description}}</td>
                    <td>{{$r->severity_level}}</td>
                </tr>
            @endforeach

        </tbody>
    </table>

</div>
@endsection