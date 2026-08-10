@extends('layouts.redesign.dashboard')

@section('page-title', 'Medical Appointments')
@section('breadcrumb', 'Appointments')

@section('dashboard-content')
<div class="appointments-page">
    <div class="page-header fade-up">
        <div class="page-header-content">
            <h1>Medical Appointments</h1>
            <p>Track and manage appointment requests from your patients</p>
        </div>
    </div>

    <div class="stats-row stagger-animation">
        <div class="stat-mini-card fade-up">
            <div class="stat-mini-icon orange">
                <i class="fas fa-clock"></i>
            </div>
            <div class="stat-mini-info">
                <span class="stat-mini-value">{{ $pendingCount }}</span>
                <span class="stat-mini-label">Pending</span>
            </div>
        </div>
        <div class="stat-mini-card fade-up">
            <div class="stat-mini-icon blue">
                <i class="fas fa-calendar-check"></i>
            </div>
            <div class="stat-mini-info">
                <span class="stat-mini-value">{{ $upcomingCount }}</span>
                <span class="stat-mini-label">Upcoming</span>
            </div>
        </div>
        <div class="stat-mini-card fade-up">
            <div class="stat-mini-icon green">
                <i class="fas fa-notes-medical"></i>
            </div>
            <div class="stat-mini-info">
                <span class="stat-mini-value">{{ method_exists($appointments, 'total') ? $appointments->total() : $appointments->count() }}</span>
                <span class="stat-mini-label">Total</span>
            </div>
        </div>
    </div>

    <div class="table-section fade-up">
        <div class="table-header">
            <h3><i class="fas fa-list"></i> Appointment List</h3>
        </div>

        @if(session('success'))
            <div class="alert alert-success" style="margin: 0 var(--space-lg) var(--space-md);">{{ session('success') }}</div>
        @endif

        @php
            $statusMap = [
                'pending' => 'warning',
                'confirmed' => 'info',
                'completed' => 'success',
                'cancelled' => 'danger',
                'rescheduled' => 'secondary',
            ];
            $paymentMap = [
                'paid' => 'success',
                'unpaid' => 'danger',
                'partial' => 'warning',
            ];
        @endphp

        @if($appointments->count())
            <div class="table-responsive">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Patient</th>
                            <th>Date & Time</th>
                            <th>Service</th>
                            <th>Status</th>
                            <th>Payment</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($appointments as $appointment)
                            <tr>
                                <td>#{{ $appointment->id }}</td>
                                <td>
                                    <strong>{{ $appointment->patient_name }}</strong><br>
                                    <span class="text-muted">{{ $appointment->patient_mobile }}</span>
                                </td>
                                <td>{{ $appointment->getFormattedDateTime() }}</td>
                                <td>{{ $appointment->service ?? 'General' }}</td>
                                <td>
                                    <span class="status-badge {{ $statusMap[$appointment->status] ?? 'secondary' }}">
                                        {{ ucfirst($appointment->status) }}
                                    </span>
                                </td>
                                <td>
                                    <span class="status-badge {{ $paymentMap[$appointment->payment_status] ?? 'secondary' }}">
                                        {{ ucfirst($appointment->payment_status) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="table-actions">
                                        @if($appointment->status === 'pending')
                                            <form action="{{ route('user.medical.appointment.updateStatus', $appointment->id) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="status" value="confirmed">
                                                <button type="submit" class="action-btn success" title="Confirm">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            </form>
                                        @endif
                                        @if($appointment->status === 'confirmed')
                                            <form action="{{ route('user.medical.appointment.updateStatus', $appointment->id) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="status" value="completed">
                                                <button type="submit" class="action-btn warning" title="Complete">
                                                    <i class="fas fa-check-double"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if(method_exists($appointments, 'links'))
                <div class="table-footer">
                    {{ $appointments->links() }}
                </div>
            @endif
        @else
            <div class="empty-state">
                <div class="empty-state-icon">
                    <i class="fas fa-calendar-times"></i>
                </div>
                <h3>No appointments yet</h3>
                <p>New appointment requests will appear here.</p>
            </div>
        @endif
    </div>
</div>
@include('userdashboard-new.partials.content-page-styles')
@include('userdashboard-new.partials.table-page-styles')
@endsection
