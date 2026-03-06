@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between mb-3">
    <h3>Users</h3>

    <a href="/users/create" class="btn btn-primary">
        <i class="bi bi-plus"></i> Add User
    </a>
</div>

<div class="card-box">

<table class="table">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Username</th>
        <th>Department</th>
        <th>Cell Number</th>
        <th>Email</th>
        <th>Action</th>
    </tr>

    @foreach($users as $user)
    <tr>
        <td>{{ $user->id }}</td>
        <td>{{ $user->name }} {{ $user->lastname }}</td>
        <td>{{ $user->username }}</td>
        <td>{{ optional($user->department)->name ?? 'NO DEPT' }}</td>
        <td>{{ $user->cell_number }}</td>
        <td>{{ $user->email }}</td>
        <td>
            <a href="/users/{{ $user->id }}/edit" class="btn btn-warning btn-sm">
                <i class="bi bi-pencil"></i>
            </a>

            <form method="POST" action="/users/{{ $user->id }}/delete" style="display:inline;">
                @csrf
                <button class="btn btn-danger btn-sm">
                    <i class="bi bi-trash"></i>
                </button>
            </form>
        </td>
    </tr>
    @endforeach

</table>

{{ $users->links() }}

</div>

@endsection