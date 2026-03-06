@extends('layouts.app')

@section('content')

<div class="d-flex align-items-center mb-4">
    <a href="/users" class="btn btn-outline-secondary me-3">
        <i class="bi bi-arrow-left"></i>
    </a>
    <h3>Add User</h3>
</div>

<div class="card-box">
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form method="POST" action="/users">
    @csrf

    <input type="text" name="name" required placeholder="First Name" class="form-control mb-2">
    <input type="text" name="lastname" required placeholder="Last Name" class="form-control mb-2">
    <input type="text" name="username" required placeholder="Username" class="form-control mb-2">
    <div class="mb-3">
        <label class="form-label">Division</label>
        <select name="department_id" class="form-control" required>
            <option value="">-- Select Division --</option>
            @foreach($departments as $dept)
                <option value="{{ $dept->id }}">
                    {{ $dept->name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Role</label>
        <select name="role" class="form-control" required>
            <option value="">-- Select Role --</option>
            <option value="admin">Admin</option>
            <option value="manager">Manager</option>
            <option value="staff">Staff</option>
        </select>
    </div>
    <input type="text" id="cell_number" required name="cell_number" placeholder="09XXXXXXXXX" class="form-control mb-2">
    <input type="email" name="email" required placeholder="Email" class="form-control mb-2">
    

    <button class="btn btn-success">
        <i class="bi bi-save"></i> Save
    </button>
</form>

</div>

@endsection