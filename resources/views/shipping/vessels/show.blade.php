@extends('layouts.app')

@section('content')

<a href="/shipping/vessels" class="btn btn-outline-secondary mb-3">
    ← Back to Vessel List
</a>

<h3 class="mb-3">{{ $vessel->vessel_name }}</h3>

<div class="card mb-4">
    <div class="card-body">
        <p><strong>IMO:</strong> {{ $vessel->imo_number }}</p>
        <p><strong>Call Sign:</strong> {{ $vessel->call_sign }}</p>
    </div>
</div>

<a href="/shipping/vessels/{{ $vessel->id }}/logs/create" 
   class="btn btn-primary mb-3">
   + Add Voyage Log
</a>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table mb-0">
            <thead class="table-light">
                <tr>
                    <th>Date Started</th>
                    <th>Port</th>
                    <th>Voyage #</th>
                    <th>Status</th>
                    <th>Activity</th>
                    <th>Time Start</th>
                    <th>Time End</th>
                    <th>Total Hrs</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($vessel->voyageLogs as $log)
                <tr>
                    <td>{{ $log->date_started }}</td>
                    <td>{{ $log->port_location }}</td>
                    <td>{{ $log->voyage_number }}</td>
                    <td>
                        @php
                            $status = strtolower($log->voyage_status);
                        @endphp

                        @if($status == 'sailing')
                            <span class="badge bg-danger">Sailing</span>
                        @elseif($status == 'anchored')
                            <span class="badge bg-warning text-dark">Anchored</span>
                        @elseif($status == 'at berth')
                            <span class="badge bg-secondary">At Berth</span>
                        @else
                            <span class="badge bg-info">{{ $log->voyage_status }}</span>
                        @endif
                    </td>
                    <td>{{ $log->activity }}</td>
                    <td>{{ $log->time_started }}</td>
                    <td>{{ $log->time_finished }}</td>
                    <td>{{ $log->total_hrs }}</td>
                    <td>
                        <a href="/shipping/vessels/{{ $vessel->id }}/logs/{{ $log->id }}/edit" 
                            class="btn btn-sm btn-warning">Edit
                        </a>
                        <form method="POST" 
                            action="/shipping/vessels/{{ $vessel->id }}/logs/{{ $log->id }}"
                            style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger"
                                onclick="return confirm('Delete this log?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">
                        No voyage logs yet
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection