@extends('layouts.redesign.dashboard')

@section('page-title', 'Add Service')
@section('breadcrumb', 'Add Service')

@section('dashboard-content')
<div class="form-page">
    <div class="page-header fade-up">
        <div class="page-header-content">
            <h1>Add Service</h1>
            <p>Add a new professional service</p>
        </div>
        <div class="page-header-actions">
            <a href="{{ url('/myprofessions') }}" class="btn btn-outline">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    <form action="{{ url('/saveprofessions') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-card fade-up">
            <div class="form-card-header">
                <h3><i class="fas fa-briefcase"></i> Service Details</h3>
            </div>
            <div class="form-card-body">
                <div class="form-row">
                    <div class="form-group">
                        <label for="profession">Service Name <span class="required">*</span></label>
                        <input type="text" id="profession" name="profession" value="{{ old('profession') }}"
                               class="form-control @error('profession') is-invalid @enderror"
                               placeholder="e.g., Web Development" required>
                        @error('profession')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Contact Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                               class="form-control @error('email') is-invalid @enderror"
                               placeholder="contact@example.com">
                        @error('email')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" rows="4"
                              class="form-control @error('description') is-invalid @enderror"
                              placeholder="Describe your service...">{{ old('description') }}</textarea>
                    @error('description')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-card-footer">
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="fas fa-save"></i> Save Service
                </button>
                <a href="{{ url('/myprofessions') }}" class="btn btn-outline btn-lg">Cancel</a>
            </div>
        </div>
    </form>
</div>
@include('userdashboard-new.partials.form-page-styles')
@endsection
