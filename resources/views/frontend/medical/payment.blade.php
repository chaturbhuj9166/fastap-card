@extends('frontend.medical.layout')

@section('title', 'Payment - ' . $customer->name)

@section('content')
<div class="medical-payment py-5" style="background: #f8f9fa; min-height: 100vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-lg border-0">
                    <div class="card-header bg-success text-white">
                        <h4 class="mb-0"><i class="fas fa-credit-card me-2"></i>Payment</h4>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('medical.payment.process') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="customer_id" value="{{ $customer->id }}">
                            @if($appointment)
                                <input type="hidden" name="appointment_id" value="{{ $appointment->id }}">
                            @endif

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Patient Name *</label>
                                    <input type="text" name="patient_name" class="form-control" value="{{ $appointment->patient_name ?? '' }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Mobile Number *</label>
                                    <input type="tel" name="patient_mobile" class="form-control" value="{{ $appointment->patient_mobile ?? '' }}" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="patient_email" class="form-control" value="{{ $appointment->patient_email ?? '' }}">
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Service Type *</label>
                                    <input type="text" name="service_type" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Amount (₹) *</label>
                                    <input type="number" name="amount" class="form-control" min="0" step="0.01" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Payment Mode *</label>
                                <select name="payment_mode" class="form-select" required>
                                    <option value="upi">UPI</option>
                                    <option value="card">Card</option>
                                    <option value="cash">Cash</option>
                                    <option value="bank_transfer">Bank Transfer</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">UPI Transaction ID</label>
                                <input type="text" name="upi_transaction_id" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Payment Screenshot</label>
                                <input type="file" name="payment_screenshot" class="form-control" accept="image/*">
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-success btn-lg">
                                    <i class="fas fa-check-circle me-2"></i>Submit Payment
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
