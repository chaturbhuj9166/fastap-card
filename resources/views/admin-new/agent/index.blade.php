@extends('layouts.redesign.admin')

@section('page-title', 'Manage Franchise')
@section('breadcrumb', 'Franchise')

@push('page-styles')
<style>
    .agent-stats {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: var(--space-md);
        margin-bottom: var(--space-lg);
    }

    .agent-stat-card {
        background: var(--card-bg);
        border: 1px solid var(--card-border);
        border-radius: var(--radius-lg);
        padding: var(--space-lg);
        display: flex;
        align-items: center;
        gap: var(--space-md);
    }

    .agent-stat-icon {
        width: 48px;
        height: 48px;
        border-radius: var(--radius-lg);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: var(--text-xl);
    }

    .agent-stat-value {
        font-size: var(--text-2xl);
        font-weight: var(--font-bold);
        color: var(--text-primary);
    }

    .agent-stat-label {
        font-size: var(--text-sm);
        color: var(--text-muted);
    }

    .agent-code {
        font-family: monospace;
        background: var(--bg-tertiary);
        padding: var(--space-xs) var(--space-sm);
        border-radius: var(--radius-sm);
        font-size: var(--text-sm);
    }

    .earning-amount {
        font-weight: var(--font-semibold);
        color: var(--green-500);
    }

    .status-toggle {
        position: relative;
        width: 44px;
        height: 24px;
        background: var(--bg-tertiary);
        border-radius: 12px;
        cursor: pointer;
        transition: background var(--transition-fast);
    }

    .status-toggle.active {
        background: var(--green-500);
    }

    .status-toggle::after {
        content: '';
        position: absolute;
        top: 2px;
        left: 2px;
        width: 20px;
        height: 20px;
        background: white;
        border-radius: 50%;
        transition: transform var(--transition-fast);
    }

    .status-toggle.active::after {
        transform: translateX(20px);
    }

    .action-buttons {
        display: flex;
        gap: var(--space-xs);
    }

    .action-buttons .btn {
        padding: var(--space-xs) var(--space-sm);
        font-size: var(--text-sm);
    }

    @media (max-width: 1024px) {
        .agent-stats {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('admin-content')
@php
    $totalAgents = DB::table('agents')->count();
    $activeAgents = DB::table('agents')->where('status', 1)->count();
    $inactiveAgents = DB::table('agents')->where('status', 0)->count();
@endphp

<!-- Agent Stats -->
<div class="agent-stats">
    <div class="agent-stat-card">
        <div class="agent-stat-icon" style="background: rgba(124, 58, 237, 0.1); color: var(--purple-500);">
            <i class="fas fa-users"></i>
        </div>
        <div>
            <div class="agent-stat-value">{{ number_format($totalAgents) }}</div>
            <div class="agent-stat-label">Total Franchise</div>
        </div>
    </div>
    <div class="agent-stat-card">
        <div class="agent-stat-icon" style="background: rgba(16, 185, 129, 0.1); color: var(--green-500);">
            <i class="fas fa-user-check"></i>
        </div>
        <div>
            <div class="agent-stat-value">{{ number_format($activeAgents) }}</div>
            <div class="agent-stat-label">Active Franchise</div>
        </div>
    </div>
    <div class="agent-stat-card">
        <div class="agent-stat-icon" style="background: rgba(239, 68, 68, 0.1); color: var(--red-500);">
            <i class="fas fa-user-times"></i>
        </div>
        <div>
            <div class="agent-stat-value">{{ number_format($inactiveAgents) }}</div>
            <div class="agent-stat-label">Inactive Franchise</div>
        </div>
    </div>
</div>

<!-- Page Header -->
<div class="table-header" style="background: var(--card-bg); border: 1px solid var(--card-border); border-radius: var(--radius-xl); padding: var(--space-lg); margin-bottom: var(--space-lg);">
    <div>
        <h2 class="table-title">All Franchise Partners</h2>
        <p style="color: var(--text-muted); font-size: var(--text-sm); margin-top: var(--space-xs);">Manage your franchise partners and their earnings</p>
    </div>
    <div class="table-actions">
        <a href="{{ url('/admin/addagent') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Add Franchise
        </a>
    </div>
</div>

<!-- Filters -->
<div class="filters-bar" style="display: flex; align-items: center; gap: var(--space-md); margin-bottom: var(--space-lg); flex-wrap: wrap;">
    <div class="filter-tabs" style="display: flex; background: var(--bg-secondary); border-radius: var(--radius-lg); padding: var(--space-xs);">
        <button class="filter-tab active" data-filter="all" style="padding: var(--space-sm) var(--space-lg); border-radius: var(--radius-md); font-size: var(--text-sm); font-weight: var(--font-medium); color: var(--text-secondary); background: var(--bg-primary); border: none; cursor: pointer; box-shadow: var(--shadow-sm);">All</button>
        <button class="filter-tab" data-filter="active" style="padding: var(--space-sm) var(--space-lg); border-radius: var(--radius-md); font-size: var(--text-sm); font-weight: var(--font-medium); color: var(--text-secondary); background: transparent; border: none; cursor: pointer;">Active</button>
        <button class="filter-tab" data-filter="inactive" style="padding: var(--space-sm) var(--space-lg); border-radius: var(--radius-md); font-size: var(--text-sm); font-weight: var(--font-medium); color: var(--text-secondary); background: transparent; border: none; cursor: pointer;">Inactive</button>
    </div>
    <div style="flex: 1;"></div>
    <div class="table-search">
        <i class="fas fa-search"></i>
        <input type="text" id="agentSearch" placeholder="Search franchise...">
    </div>
</div>

<!-- Agents Table -->
<div class="table-container">
    <table class="data-table" id="agentsTable">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Contact</th>
                <th>Franchise Code</th>
                <th>Total Earning</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @php $i = 0; @endphp
            @forelse($agents as $agent)
            @php
                // Calculate total earnings
                $totalCalculatedPercentage = 0;
                $TotalOrders = \App\Models\Order::where('agent_code', '=', $agent->id)
                    ->orderBy('created_at', 'desc')
                    ->get();

                foreach($TotalOrders as $order) {
                    $totalAmount = $order->total_amount;
                    $percentage = $order->agent_commission;
                    $calculatedPercentage = ($percentage / 100) * $totalAmount;
                    $totalCalculatedPercentage += $calculatedPercentage;
                }
            @endphp
            <tr data-status="{{ $agent->status == 1 ? 'active' : 'inactive' }}">
                <td>{{ ++$i }}</td>
                <td style="font-weight: var(--font-medium);">{{ $agent->name }}</td>
                <td>
                    <div style="font-size: var(--text-sm);">
                        <i class="fas fa-phone" style="color: var(--text-muted); margin-right: 4px;"></i>{{ $agent->mobile }}
                    </div>
                    <div style="font-size: var(--text-sm); color: var(--text-muted);">
                        <i class="fas fa-envelope" style="margin-right: 4px;"></i>{{ $agent->email }}
                    </div>
                </td>
                <td>
                    <span class="agent-code">{{ $agent->agent_code }}</span>
                </td>
                <td>
                    <span class="earning-amount">₹ {{ number_format($totalCalculatedPercentage, 2) }}</span>
                </td>
                <td>
                    <div class="status-toggle {{ $agent->status == 1 ? 'active' : '' }}"
                         data-id="{{ $agent->id }}"
                         onclick="toggleStatus(this)">
                    </div>
                </td>
                <td>
                    <div class="action-buttons">
                        <a href="{{ url('/admin/viewagent/' . $agent->id . '/viewagent') }}" class="btn btn-icon btn-sm" title="View">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ url('/admin/editagent/' . $agent->id . '/editagent') }}" class="btn btn-icon btn-sm" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="{{ url('/admin/agentdelete/' . $agent->id) }}" class="btn btn-icon btn-sm btn-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this franchise?')">
                            <i class="fas fa-trash"></i>
                        </a>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align: center; padding: var(--space-xl);">
                    <div style="color: var(--text-muted);">
                        <i class="fas fa-users-slash" style="font-size: var(--text-3xl); margin-bottom: var(--space-md);"></i>
                        <p>No franchise partners found</p>
                        <a href="{{ url('/admin/addagent') }}" class="btn btn-primary btn-sm" style="margin-top: var(--space-md);">
                            <i class="fas fa-plus"></i> Add First Franchise
                        </a>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Pagination -->
@if($agents->hasPages())
<div style="margin-top: var(--space-lg); display: flex; justify-content: center;">
    {{ $agents->links() }}
</div>
@endif

@endsection

@push('page-scripts')
<script>
    // Status toggle function
    function toggleStatus(element) {
        const id = element.dataset.id;
        const isActive = element.classList.contains('active');
        const newStatus = isActive ? 0 : 1;

        fetch('{{ url("/admin/agent.update.status") }}?id=' + id + '&status=' + newStatus, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (newStatus === 1) {
                element.classList.add('active');
            } else {
                element.classList.remove('active');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    // Search functionality
    document.getElementById('agentSearch').addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const rows = document.querySelectorAll('#agentsTable tbody tr');

        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchTerm) ? '' : 'none';
        });
    });

    // Filter tabs
    document.querySelectorAll('.filter-tab').forEach(tab => {
        tab.addEventListener('click', function() {
            document.querySelectorAll('.filter-tab').forEach(t => {
                t.classList.remove('active');
                t.style.background = 'transparent';
                t.style.boxShadow = 'none';
            });
            this.classList.add('active');
            this.style.background = 'var(--bg-primary)';
            this.style.boxShadow = 'var(--shadow-sm)';

            const filter = this.dataset.filter;
            const rows = document.querySelectorAll('#agentsTable tbody tr');

            rows.forEach(row => {
                if (filter === 'all') {
                    row.style.display = '';
                } else {
                    row.style.display = row.dataset.status === filter ? '' : 'none';
                }
            });
        });
    });
</script>
@endpush
