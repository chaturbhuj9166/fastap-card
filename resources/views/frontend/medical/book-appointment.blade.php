@extends('frontend.medical.layout')

@section('title', 'Book Appointment - ' . $customer->name)

@section('content')
<div class="book-appointment py-5" style="background: #f8f9fa; min-height: 100vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-lg border-0">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0"><i class="fas fa-calendar-check me-2"></i>Book Appointment</h4>
                    </div>
                    <div class="card-body p-4">
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <form action="{{ route('medical.appointment.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="customer_id" value="{{ $customer->id }}">

                            <div class="mb-4">
                                <label class="form-label">Select Profile Type *</label>
                                <select name="profile_type" class="form-select" required>
                                    <option value="">-- Select --</option>
                                    @foreach($profiles as $profile)
                                        <option value="{{ $profile->profile_type }}">{{ $profile->getProfileTypeLabel() }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Full Name *</label>
                                    <input type="text" name="patient_name" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Mobile Number *</label>
                                    <input type="tel" name="patient_mobile" class="form-control" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="patient_email" class="form-control">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">Age</label>
                                    <input type="number" name="patient_age" class="form-control" min="1" max="120">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">Gender</label>
                                    <select name="patient_gender" class="form-select">
                                        <option value="">--</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Appointment Date *</label>
                                    <input type="date" name="appointment_date" class="form-control" min="{{ date('Y-m-d') }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Preferred Time *</label>
                                    <input type="time" name="appointment_time" class="form-control" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Service</label>
                                <input type="text" name="service" class="form-control" placeholder="e.g., General Consultation, Check-up">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Symptoms / Notes</label>
                                <textarea name="symptoms" class="form-control" rows="3"></textarea>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-check-circle me-2"></i>Book Appointment
                                </button>
                                <a href="{{ url($customer->slug . '/medical') }}" class="btn btn-outline-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
