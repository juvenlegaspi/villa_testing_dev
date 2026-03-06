@extends('layouts.app')

@section('content')

<div class="container">
    <h3 class="mb-4">📊 Dashboard Summary</h3>

    <div class="row">

        <div class="col-md-3 mb-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h5>Total Vessels</h5>
                    <h2>{{ $totalVessels }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h5>Total Voyage Logs</h5>
                    <h2>{{ $totalLogs }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center text-warning">
                    <h5>Anchored</h5>
                    <h2>{{ $anchored }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center text-success">
                    <h5>Sailing</h5>
                    <h2>{{ $sailing }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-12 mt-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h5>Total Crew On Board</h5>
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <h5 class="text-center">Voyage Status Distribution</h5>
                                    <canvas id="statusChart"></canvas>
                                </div>
                            </div>
                        </div>
                </div>
                    <h2>{{ $totalCrew }}</h2> 
                </div>
            </div>
        </div>

    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('statusChart');

    const anchored = {{ $anchored }};
    const sailing = {{ $sailing }};
    const total = anchored + sailing;

    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Anchored', 'Sailing'],
            datasets: [{
                data: [anchored, sailing],
                backgroundColor: ['#ffc107', '#198754'],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            cutout: '65%', // para mas donut look
            plugins: {
                legend: {
                    position: 'top'
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let value = context.raw;
                            let percentage = ((value / total) * 100).toFixed(1);
                            return context.label + ': ' + value + ' (' + percentage + '%)';
                        }
                    }
                }
            }
        }
    });
</script>
@endsection

