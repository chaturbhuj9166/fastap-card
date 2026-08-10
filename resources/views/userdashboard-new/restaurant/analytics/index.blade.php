@extends('layouts.redesign.dashboard')

@section('title', 'Restaurant Analytics')

@section('dashboard-content')
<div class="content-page">
    <div class="content-header">
        <div class="content-header-left">
            <h1 class="content-title">Analytics</h1>
            <p class="content-subtitle">Quick view of orders and revenue</p>
        </div>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <h3>Table Revenue</h3>
            <p>Rs. {{ number_format($tableRevenue ?? 0, 2) }}</p>
        </div>
        <div class="stat-card">
            <h3>Room Revenue</h3>
            <p>Rs. {{ number_format($roomRevenue ?? 0, 2) }}</p>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Status Breakdown</h3>
        </div>
        <div class="card-body">
            <div class="status-grid">
                <div>
                    <h4>Table Orders</h4>
                    <ul>
                        @foreach($statusCounts['table'] ?? [] as $status => $count)
                            <li>{{ ucfirst($status) }}: {{ $count }}</li>
                        @endforeach
                    </ul>
                </div>
                <div>
                    <h4>Room Service</h4>
                    <ul>
                        @foreach($statusCounts['room'] ?? [] as $status => $count)
                            <li>{{ ucfirst($status) }}: {{ $count }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Last 7 Days</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Table Orders</th>
                            <th>Room Orders</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($last7Days as $day)
                            <tr>
                                <td>{{ $day['date'] }}</td>
                                <td>{{ $day['table_orders'] }}</td>
                                <td>{{ $day['room_orders'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    .stats-grid { display: grid; gap: 1rem; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); margin-bottom: 1.5rem; }
    .stat-card { background: var(--card-bg); border: 1px solid var(--border-color); border-radius: 0.75rem; padding: 1rem; }
    .status-grid { display: grid; gap: 1rem; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); }
    .table { width: 100%; border-collapse: collapse; }
    .table th, .table td { padding: 0.75rem; border-bottom: 1px solid var(--border-color); }
    .table-responsive { overflow-x: auto; }
</style>
@endsection
