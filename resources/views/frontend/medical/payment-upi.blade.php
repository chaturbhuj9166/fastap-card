@extends('frontend.medical.layout')

@section('title', 'UPI Payment - ' . $customer->name)

@section('content')
<div class="upi-payment py-5" style="background: #f8f9fa; min-height: 100vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card shadow-lg border-0">
                    <div class="card-header bg-success text-white">
                        <h4 class="mb-0"><i class="fas fa-mobile-alt me-2"></i>UPI Payment</h4>
                    </div>
                    <div class="card-body p-4">
                        <div class="text-center mb-4">
                            <h2 class="text-success mb-0">₹{{ number_format($amount ?? 0, 2) }}</h2>
                            <p class="text-muted">{{ $serviceType ?? 'Medical Service' }}</p>
                        </div>

                        @if($upiQrCode)
                            <div class="text-center mb-4">
                                <div class="card border-success">
                                    <div class="card-body">
                                        <p class="mb-3"><strong>Scan QR Code to Pay</strong></p>
                                        <img src="{{ asset('storage/' . $upiQrCode) }}" alt="UPI QR Code" style="max-width: 300px;" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if($upiId)
                            <div class="text-center mb-4">
                                <p class="mb-2"><strong>OR Pay directly to UPI ID:</strong></p>
                                <div class="alert alert-success">
                                    <h5 class="mb-0">{{ $upiId }}</h5>
                                </div>
                                <button class="btn btn-outline-success btn-sm" onclick="copyUPI()">
                                    <i class="fas fa-copy me-1"></i>Copy UPI ID
                                </button>
                            </div>
                        @endif

                        <hr>

                        <form action="{{ route('medical.payment.process') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="customer_id" value="{{ $customer->id }}">
                            <input type="hidden" name="amount" value="{{ $amount ?? 0 }}">
                            <input type="hidden" name="service_type" value="{{ $serviceType ?? '' }}">
                            <input type="hidden" name="payment_mode" value="upi">

                            <div class="mb-3">
                                <label class="form-label">Your Name *</label>
                                <input type="text" name="patient_name" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Mobile Number *</label>
                                <input type="tel" name="patient_mobile" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">UPI Transaction ID / Reference Number *</label>
                                <input type="text" name="upi_transaction_id" class="form-control" required placeholder="e.g., 123456789012">
                                <small class="text-muted">Enter the 12-digit UPI transaction ID from your payment app</small>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Payment Screenshot (Optional)</label>
                                <input type="file" name="payment_screenshot" class="form-control" accept="image/*">
                                <small class="text-muted">Upload screenshot of payment confirmation</small>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-success btn-lg">
                                    <i class="fas fa-check-circle me-2"></i>Confirm Payment
                                </button>
                                <a href="{{ url($customer->slug . '/medical') }}" class="btn btn-outline-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <p class="text-muted small">
                        <i class="fas fa-shield-alt me-1"></i>Secure Payment | Your payment details are safe
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function copyUPI() {
    const upiId = '{{ $upiId ?? '' }}';
    navigator.clipboard.writeText(upiId).then(() => {
        alert('UPI ID copied to clipboard!');
    });
}
</script>
@endsection
