@extends('layouts.redesign.company')

@section('page-title', 'Restaurant Analytics')
@section('breadcrumb', 'Restaurant Analytics')

@section('company-content')
<div class="restaurant-page">
    <div class="page-header">
        <div class="page-header-left">
            <h2>Analytics</h2>
            <p>Quick view of orders and revenue</p>
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

    <div class="settings-card">
        <div class="card-header">
            <h3>Status Breakdown</h3>
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

    <div class="settings-card">
        <div class="card-header">
            <h3>Last 7 Days</h3>
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

@push('page-styles')
<style>
    .stats-grid { display: grid; gap: 1rem; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); margin-bottom: 1.5rem; }
    .stat-card { background: var(--bg-primary); border: 1px solid var(--border-color); border-radius: 0.75rem; padding: 1rem; }
    .status-grid { display: grid; gap: 1rem; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); }
    .table { width: 100%; border-collapse: collapse; }
    .table th, .table td { padding: 0.75rem; border-bottom: 1px solid var(--border-color); }
    .table-responsive { overflow-x: auto; }
    .settings-card { margin-bottom: 1.5rem; }
</style>
@endpush
@endsection
