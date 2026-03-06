@extends('layouts.app')

@section('content')

<div class="d-flex align-items-center mb-4">
    <a href="/users" class="btn btn-outline-secondary me-3">
        <i class="bi bi-arrow-left"></i>
    </a>
    <h3>Edit User</h3>
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
<form method="POST" action="/users/{{ $user->id }}/update">
    @csrf

    <input type="text" name="name" required value="{{ $user->name }}" class="form-control mb-2">
    <input type="text" name="lastname" required value="{{ $user->lastname }}" class="form-control mb-2">
    <input type="text" name="username" required value="{{ $user->username }}" class="form-control mb-2">
    <input type="text" name="cell_number" required value="{{ $user->cell_number }}" class="form-control mb-2">
    <input type="email" name="email" required value="{{ $user->email }}" class="form-control mb-2">

    <button class="btn btn-success">
        <i class="bi bi-save"></i> Update
    </button>
</form>

</div>

@endsection