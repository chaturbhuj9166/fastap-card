@extends('frontend.medical.layout')

@section('title', 'Payment Successful')

@section('content')
<div class="payment-success py-5" style="background: #f8f9fa; min-height: 100vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card shadow-lg border-0">
                    <div class="card-body p-5 text-center">
                        <i class="fas fa-check-circle text-success" style="font-size: 72px;"></i>
                        <h2 class="mt-4 mb-3">Payment Successful!</h2>
                        <p class="text-muted">Your payment has been received successfully.</p>

                        <div class="bg-light p-4 rounded my-4">
                            <div class="row mb-2">
                                <div class="col-6 text-start">Receipt No:</div>
                                <div class="col-6 text-end"><strong>{{ $payment->receipt_number }}</strong></div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-6 text-start">Amount:</div>
                                <div class="col-6 text-end"><strong class="text-success">{{ $payment->getFormattedFinalAmount() }}</strong></div>
                            </div>
                            <div class="row">
                                <div class="col-6 text-start">Payment Mode:</div>
                                <div class="col-6 text-end">{{ ucfirst($payment->payment_mode) }}</div>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <a href="#" onclick="window.print()" class="btn btn-primary">
                                <i class="fas fa-download me-2"></i>Download Receipt
                            </a>
                            <a href="{{ url('/') }}" class="btn btn-outline-secondary">Back to Home</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
