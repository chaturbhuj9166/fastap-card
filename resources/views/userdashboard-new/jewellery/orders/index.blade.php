@extends('layouts.redesign.dashboard')

@section('title', 'Jewellery Custom Orders')

@section('dashboard-content')
<div class="content-page">
    <div class="content-header">
        <div class="content-header-left">
            <h1 class="content-title">Custom Orders</h1>
            <p class="content-subtitle">Manage custom jewellery requests</p>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Add Custom Order</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('/user/jewellery/orders') }}" class="form-grid" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="form-label">Client Name</label>
                    <input type="text" name="client_name" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Client Mobile</label>
                    <input type="text" name="client_mobile" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Client Email</label>
                    <input type="email" name="client_email" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Order Type</label>
                    <input type="text" name="order_type" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Category</label>
                    <input type="text" name="category" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Budget Range</label>
                    <input type="text" name="budget_range" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Metal Preference</label>
                    <input type="text" name="metal_preference" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Stone Preference</label>
                    <input type="text" name="stone_preference" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Timeline Required</label>
                    <input type="text" name="timeline_required" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Quoted Amount</label>
                    <input type="number" name="quoted_amount" class="form-input" step="0.01" min="0">
                </div>
                <div class="form-group">
                    <label class="form-label">Advance Paid</label>
                    <input type="number" name="advance_paid" class="form-input" step="0.01" min="0">
                </div>
                <div class="form-group">
                    <label class="form-label">Status</label>
                    <select name="order_status" class="form-input">
                        <option value="inquiry">Inquiry</option>
                        <option value="design_approval">Design Approval</option>
                        <option value="in_making">In Making</option>
                        <option value="ready">Ready</option>
                        <option value="delivered">Delivered</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Appointment Date</label>
                    <input type="date" name="appointment_date" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Appointment Time</label>
                    <input type="text" name="appointment_time" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Reference Images</label>
                    <input type="file" name="reference_images[]" class="form-input" multiple>
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Special Requirements</label>
                    <textarea name="special_requirements" class="form-input" rows="3"></textarea>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Add Order</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Custom Orders</h3>
        </div>
        <div class="card-body">
            @if($orders->count() === 0)
                <p class="empty-state">No custom orders yet.</p>
            @else
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Client</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Budget</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                            <tr>
                                <td>{{ $order->client_name }}</td>
                                <td>{{ $order->order_type ?? '-' }}</td>
                                <td>{{ ucfirst(str_replace('_', ' ', $order->order_status)) }}</td>
                                <td>{{ $order->budget_range ?? '-' }}</td>
                                <td>
                                    <form method="POST" action="{{ url('/user/jewellery/orders/' . $order->id . '/status') }}" class="inline-form">
                                        @csrf
                                        <select name="order_status" class="form-input form-input-sm">
                                            <option value="inquiry" {{ $order->order_status === 'inquiry' ? 'selected' : '' }}>Inquiry</option>
                                            <option value="design_approval" {{ $order->order_status === 'design_approval' ? 'selected' : '' }}>Design Approval</option>
                                            <option value="in_making" {{ $order->order_status === 'in_making' ? 'selected' : '' }}>In Making</option>
                                            <option value="ready" {{ $order->order_status === 'ready' ? 'selected' : '' }}>Ready</option>
                                            <option value="delivered" {{ $order->order_status === 'delivered' ? 'selected' : '' }}>Delivered</option>
                                        </select>
                                        <button type="submit" class="btn btn-sm btn-outline">Update</button>
                                    </form>
                                    <form method="POST" action="{{ url('/user/jewellery/orders/' . $order->id) }}" class="inline-form" onsubmit="return confirm('Delete this order?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
    .form-grid { display: grid; gap: 1rem; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); align-items: end; }
    .form-actions { display: flex; justify-content: flex-end; }
    .form-group.full-width { grid-column: 1 / -1; }
    .inline-form { display: inline-flex; gap: 0.5rem; align-items: center; margin-right: 0.5rem; }
    .form-input-sm { max-width: 160px; }
    .empty-state { color: var(--text-secondary); }
    .table { width: 100%; border-collapse: collapse; }
    .table th, .table td { padding: 0.75rem; border-bottom: 1px solid var(--border-color); }
    .table-responsive { overflow-x: auto; }
    .btn { padding: 0.5rem 0.9rem; border-radius: 0.5rem; }
    .btn-sm { padding: 0.3rem 0.6rem; font-size: 0.8rem; }
    .btn-outline { border: 1px solid var(--border-color); background: transparent; }
    .btn-danger { background: #dc2626; color: #fff; border: none; }
</style>
@endsection
