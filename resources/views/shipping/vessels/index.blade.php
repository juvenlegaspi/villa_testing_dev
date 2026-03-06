@extends('layouts.app')

@section('content')

<h3 class="mb-4">Vessel List</h3>

<a href="/shipping/vessels/create" class="btn btn-primary mb-3">+ Add Vessel</a>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table mb-0">
            <thead class="table-light">
                <tr>
                    <th>Vessel Name</th>
                    <th>IMO</th>
                    <th>Call Sign</th>
                </tr>
            </thead>
            <tbody>
                @forelse($vessels as $vessel)
                    <tr>
                        <td>
                            <a href="/shipping/vessels/{{ $vessel->id }}" class="fw-bold text-decoration-none">
                                {{ $vessel->vessel_name }}
                            </a>
                        </td>
                        <td>{{ $vessel->imo_number }}</td>
                        <td>{{ $vessel->call_sign }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">No vessels yet</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection