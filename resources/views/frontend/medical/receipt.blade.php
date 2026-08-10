@extends('frontend.medical.layout')

@section('title', 'Payment Receipt')

@section('content')
<div class="payment-receipt py-5" style="background: #f8f9fa; min-height: 100vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-lg border-0" id="receipt">
                    <div class="card-body p-5">
                        <!-- Header -->
                        <div class="text-center mb-4">
                            <h2 class="text-success mb-1">
                                <i class="fas fa-check-circle"></i> Payment Receipt
                            </h2>
                            <p class="text-muted">Receipt #{{ $payment->receipt_number }}</p>
                        </div>

                        <hr>

                        <!-- Payment Details -->
                        <div class="row mb-4">
                            <div class="col-6">
                                <p class="mb-1"><strong>Date:</strong></p>
                                <p>{{ $payment->created_at->format('d M Y, h:i A') }}</p>
                            </div>
                            <div class="col-6 text-end">
                                <p class="mb-1"><strong>Payment Status:</strong></p>
                                <span class="badge bg-success">{{ ucfirst($payment->status) }}</span>
                            </div>
                        </div>

                        <!-- Customer Details -->
                        <div class="mb-4">
                            <h5>Bill To:</h5>
                            <p class="mb-1">{{ $payment->patient_name }}</p>
                            <p class="mb-1">{{ $payment->patient_mobile }}</p>
                            @if($payment->patient_email)
                                <p class="mb-0">{{ $payment->patient_email }}</p>
                            @endif
                        </div>

                        <!-- Service Details -->
                        <div class="table-responsive mb-4">
                            <table class="table">
                                <thead class="table-light">
                                    <tr>
                                        <th>Service Description</th>
                                        <th class="text-end">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $payment->service_type }}</td>
                                        <td class="text-end">₹{{ number_format($payment->amount, 2) }}</td>
                                    </tr>
                                    @if($payment->discount > 0)
                                        <tr>
                                            <td>Discount</td>
                                            <td class="text-end text-danger">- ₹{{ number_format($payment->discount, 2) }}</td>
                                        </tr>
                                    @endif
                                    @if($payment->gst_amount > 0)
                                        <tr>
                                            <td>GST</td>
                                            <td class="text-end">₹{{ number_format($payment->gst_amount, 2) }}</td>
                                        </tr>
                                    @endif
                                </tbody>
                                <tfoot>
                                    <tr class="table-success">
                                        <th>Total Amount</th>
                                        <th class="text-end">₹{{ number_format($payment->final_amount, 2) }}</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <!-- Payment Method -->
                        <div class="mb-4">
                            <h6>Payment Method:</h6>
                            <p class="mb-0">{{ ucfirst(str_replace('_', ' ', $payment->payment_mode)) }}</p>
                            @if($payment->upi_transaction_id)
                                <p class="mb-0"><small>Transaction ID: {{ $payment->upi_transaction_id }}</small></p>
                            @endif
                        </div>

                        <hr>

                        <!-- Footer -->
                        <div class="text-center text-muted">
                            <p class="mb-1">Thank you for choosing our services!</p>
                            <p class="mb-0 small">This is a computer-generated receipt and does not require a signature.</p>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-grid gap-2 mt-4">
                            <button onclick="window.print()" class="btn btn-primary">
                                <i class="fas fa-print me-2"></i>Print Receipt
                            </button>
                            <button onclick="downloadPDF()" class="btn btn-outline-primary">
                                <i class="fas fa-download me-2"></i>Download PDF
                            </button>
                            <a href="{{ url('/') }}" class="btn btn-outline-secondary">Back to Home</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
@media print {
    body * {
        visibility: hidden;
    }
    #receipt, #receipt * {
        visibility: visible;
    }
    #receipt {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
    }
    .btn {
        display: none !important;
    }
}
</style>

<script>
function downloadPDF() {
    window.print();
}
</script>
@endsection
