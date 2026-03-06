<!DOCTYPE html>
<html>
<head>
    <title>Villa System</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        body {
            background: #f4f6f9;
        }

        .sidebar {
            height: 100vh;
            background: linear-gradient(180deg, #1e3c72, #2a5298);
            color: white;
            padding: 20px;
        }

        .sidebar a {
            display: block;
            color: #cbd5e1;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 5px;
            text-decoration: none;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: rgba(255,255,255,0.1);
            color: white;
        }

        .topbar {
            background: white;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .card-box {
            border-radius: 15px;
            padding: 20px;
            background: white;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .table {
            background: white;
            border-radius: 10px;
            overflow: hidden;
        }
    </style>
</head>

<body>

<div class="container-fluid">
    <div class="row">

        <!-- SIDEBAR -->
        <div class="col-2 sidebar">
            <h4 class="mb-4">🏡 Villa</h4>

            <a href="/dashboard" class="{{ request()->is('dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>

            @if(in_array(auth()->user()->role, ['admin','manager']))
                <a href="/users"
                    class="{{ request()->is('users*') ? 'active' : '' }}">
                    <i class="bi bi-people"></i> Users
                </a>
            @endif

            @if(in_array(auth()->user()->role, ['admin','manager']))
                <div class="mt-3">
                    <strong class="text-white">Division</strong>

                    <div class="ms-2 mt-2">
                        @foreach($allDepartments as $dept)

                            @php
                                $isShipping = strtolower($dept->name) === 'shipping';
                            @endphp

                            @if($isShipping)

                                <div class="mt-2">

                                    <strong class="text-white">{{ $dept->name }}</strong>

                                    <div class="ms-3 mt-1">

                                        <a href="{{ url('/shipping/vessels') }}"
                                            class="d-block {{ request()->is('shipping/vessels*') ? 'text-white fw-bold' : 'text-white-50' }}">
                                            🚢 Vessels
                                        </a>

                                        <a href="{{ url('/shipping/tech-defects') }}"
                                            class="d-block {{ request()->is('shipping/tech-defects*') ? 'text-white fw-bold' : 'text-white-50' }}">
                                            🛠 Tech & Defect Reports
                                        </a>

                                </div>

    </div>

@else

    <a href="{{ url('/departments/' . $dept->id) }}"
       class="d-block {{ request()->is('departments/'.$dept->id) ? 'text-white fw-bold' : 'text-white-50' }}">
       {{ $dept->name }}
    </a>

@endif

                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        <!-- CONTENT -->
        <div class="col-10 p-4">

            <!-- TOPBAR -->
            <div class="topbar d-flex justify-content-between align-items-center">

                <h5 class="mb-0">Welcome, {{ Auth::user()->name }} 👋</h5>

                <div class="d-flex align-items-center gap-2">

                    <a href="/profile" class="btn btn-outline-primary btn-sm">
                        <i class="bi bi-person"></i> Profile
                    </a>

                    <form method="POST" action="/logout">
                        @csrf
                        <button class="btn btn-danger btn-sm">Logout</button>
                    </form>

                </div>
            </div>

            @yield('content')

        </div>

    </div>
</div>

</body>
<script>
document.getElementById('cell_number').addEventListener('input', function(e) {
    let value = e.target.value.replace(/\D/g, ''); // remove letters

    if (value.startsWith('09')) {
        value = '+63' + value.substring(1);
    } else if (value.startsWith('9')) {
        value = '+63' + value;
    }

    e.target.value = value;
});
</script>
</html>