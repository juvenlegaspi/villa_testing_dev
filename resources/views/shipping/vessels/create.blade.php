@extends('layouts.app')

@section('content')

<h3 class="mb-4">Add New Vessel</h3>

<form method="POST" action="/shipping/vessels">
    @csrf

    <div class="mb-3">
        <label>Vessel Name</label>
        <input type="text" name="vessel_name" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>IMO Number</label>
        <input type="text" name="imo_number" class="form-control">
    </div>

    <div class="mb-3">
        <label>Call Sign</label>
        <input type="text" name="call_sign" class="form-control">
    </div>

    <button class="btn btn-primary">Save Vessel</button>
</form>

@endsection