@extends('layouts.redesign.dashboard')

@section('page-title', 'Payment Settings')
@section('breadcrumb', 'Payment Settings')

@section('dashboard-content')
<div class="form-page medical-payment-settings">
    <div class="page-header fade-up">
        <div class="page-header-content">
            <h1>Payment Settings</h1>
            <p>Configure payment methods for medical appointments</p>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="form-card fade-up">
        <div class="form-card-header">
            <h3><i class="fas fa-credit-card"></i> Payment Configuration</h3>
        </div>
        <div class="form-card-body">
            <form action="{{ route('user.medical.payment.settings.save') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-section">
                    <h4>UPI Payment Details</h4>
                    <div class="form-row">
                        <div class="form-group">
                            <label>UPI ID</label>
                            <input type="text" name="upi_id" class="form-control" placeholder="yourname@upi">
                        </div>
                        <div class="form-group">
                            <label>UPI QR Code</label>
                            <input type="file" name="upi_qr_code" class="form-control" accept="image/*">
                            <span class="form-hint">Upload your UPI QR code image</span>
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <h4>Bank Account Details</h4>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Account Holder Name</label>
                            <input type="text" name="account_holder_name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Account Number</label>
                            <input type="text" name="account_number" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Bank Name</label>
                            <input type="text" name="bank_name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>IFSC Code</label>
                            <input type="text" name="ifsc_code" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Branch Name</label>
                            <input type="text" name="branch_name" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <h4>Payment Gateway (Optional)</h4>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Gateway Provider</label>
                            <select name="gateway_provider" class="form-control">
                                <option value="">-- Select --</option>
                                <option value="razorpay">Razorpay</option>
                                <option value="stripe">Stripe</option>
                                <option value="paytm">Paytm</option>
                                <option value="phonepe">PhonePe</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>API Key</label>
                            <input type="text" name="gateway_api_key" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>API Secret</label>
                            <input type="password" name="gateway_api_secret" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <h4>GST Details (Optional)</h4>
                    <div class="form-row">
                        <div class="form-group">
                            <label>GST Number</label>
                            <input type="text" name="gst_number" class="form-control" placeholder="22AAAAA0000A1Z5">
                        </div>
                        <div class="form-group">
                            <label>GST Percentage</label>
                            <select name="gst_percentage" class="form-control">
                                <option value="0">No GST</option>
                                <option value="5">5%</option>
                                <option value="12">12%</option>
                                <option value="18" selected>18%</option>
                                <option value="28">28%</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <h4>Payment Options</h4>
                    <div class="form-row">
                        <label class="form-control" style="display:flex; align-items:center; gap:8px;">
                            <input type="checkbox" name="accept_upi" value="1" checked>
                            Accept UPI
                        </label>
                        <label class="form-control" style="display:flex; align-items:center; gap:8px;">
                            <input type="checkbox" name="accept_card" value="1">
                            Accept Card
                        </label>
                        <label class="form-control" style="display:flex; align-items:center; gap:8px;">
                            <input type="checkbox" name="accept_cash" value="1" checked>
                            Accept Cash
                        </label>
                        <label class="form-control" style="display:flex; align-items:center; gap:8px;">
                            <input type="checkbox" name="accept_bank_transfer" value="1">
                            Accept Bank Transfer
                        </label>
                    </div>
                </div>

                <div class="form-card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Save Payment Settings
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.form-section {
    margin-bottom: var(--space-xl);
}

.form-section h4 {
    font-size: var(--text-base);
    font-weight: var(--font-semibold);
    margin-bottom: var(--space-md);
}
</style>
@include('userdashboard-new.partials.content-page-styles')
@include('userdashboard-new.partials.form-page-styles')
@endsection
