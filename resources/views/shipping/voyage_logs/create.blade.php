@extends('layouts.app')

@section('content')

<a href="{{ url()->previous() }}" class="btn btn-outline-secondary mb-3">
    ← Back
</a>

<h3 class="mb-4">
    Add Voyage Log - {{ $vessel->vessel_name }}
</h3>

<form method="POST" action="/shipping/vessels/{{ $vessel->id }}/logs">
    @csrf

    <div class="row">

        <div class="col-md-6 mb-3">
            <label>Date Started</label>
            <input type="date" name="date_started" class="form-control">
        </div>

        <div class="col-md-6 mb-3">
            <label>Date Completed</label>
            <input type="date" name="date_completed" class="form-control">
        </div>

        <div class="col-md-6 mb-3">
            <label>Port / Location</label>
            <input type="text" name="port_location" class="form-control">
        </div>

        <div class="col-md-6 mb-3">
            <label>Voyage #</label>
            <input type="text" name="voyage_number" class="form-control">
        </div>

        <div class="col-md-6 mb-3">
            <label>Fuel ROB</label>
            <input type="text" name="fuel_rob" class="form-control">
        </div>

        <div class="col-md-6 mb-3">
            <label>Cargo Type</label>
            <input type="text" name="cargo_type" class="form-control">
        </div>

        <div class="col-md-6 mb-3">
            <label>Cargo Volume</label>
            <input type="text" name="cargo_volume" class="form-control">
        </div>

        <div class="col-md-6 mb-3">
            <label># Crew On Board</label>
            <input type="number" name="crew_on_board" class="form-control">
        </div>

        <div class="col-md-6 mb-3">
            <label>Voyage Status</label>
            <input type="text" name="voyage_status" class="form-control">
        </div>

        <div class="col-md-6 mb-3">
            <label>Activity</label>
            <input type="text" name="activity" class="form-control">
        </div>

        <div class="col-md-6 mb-3">
            <label>Time Started</label>
            <input type="time" name="time_started" id="time_started" class="form-control">
        </div>

        <div class="col-md-6 mb-3">
            <label>Time Finished</label>
            <input type="time" name="time_finished" id="time_finished" class="form-control">
        </div>

        <div class="col-md-6 mb-3">
            <label>Total Hours</label>
            <input type="number" step="0.01" name="total_hrs" id="total_hrs" class="form-control" readonly>
        </div>

        <div class="col-12 mb-3">
            <label>Remarks / Notes</label>
            <textarea name="remarks" class="form-control" rows="3"></textarea>
        </div>

    </div>

    <button type="submit" class="btn btn-primary">
        Save Voyage Log
    </button>

</form>
<script>
document.getElementById('time_started').addEventListener('change', calculateHours);
document.getElementById('time_finished').addEventListener('change', calculateHours);

function calculateHours() {
    let start = document.getElementById('time_started').value;
    let end = document.getElementById('time_finished').value;

    if (start && end) {
        let startTime = new Date("1970-01-01T" + start + ":00");
        let endTime = new Date("1970-01-01T" + end + ":00");

        let diff = (endTime - startTime) / 1000 / 60 / 60;

        if (diff < 0) {
            diff += 24; // for overnight logs
        }

        document.getElementById('total_hrs').value = diff.toFixed(2);
    }
}
</script>
@endsection