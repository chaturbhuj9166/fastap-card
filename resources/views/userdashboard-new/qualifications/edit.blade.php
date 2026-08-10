@extends('layouts.redesign.dashboard')

@section('page-title', 'Edit Qualification')
@section('breadcrumb', 'Edit Qualification')

@section('dashboard-content')
<div class="form-page">
    <div class="page-header fade-up">
        <div class="page-header-content">
            <h1>Edit Qualification</h1>
            <p>Update your qualification details</p>
        </div>
        <div class="page-header-actions">
            <a href="{{ url('/myqualification') }}" class="btn btn-outline">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    <form action="{{ url('/updatequalifiaction') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{ $qualification->id }}">
        <div class="form-card fade-up">
            <div class="form-card-header">
                <h3><i class="fas fa-graduation-cap"></i> Qualification Details</h3>
            </div>
            <div class="form-card-body">
                <div class="form-group">
                    <label for="qualifiaction">Qualification Title <span class="required">*</span></label>
                    <input type="text" id="qualifiaction" name="qualifiaction"
                           value="{{ old('qualifiaction', $qualification->qualifiaction) }}"
                           class="form-control @error('qualifiaction') is-invalid @enderror"
                           placeholder="e.g., Bachelor's in Computer Science" required>
                    @error('qualifiaction')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Description <span class="required">*</span></label>
                    <textarea id="description" name="description" rows="4"
                              class="form-control @error('description') is-invalid @enderror"
                              placeholder="Describe your qualification..." required>{{ old('description', $qualification->description) }}</textarea>
                    @error('description')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-card-footer">
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="fas fa-save"></i> Update Qualification
                </button>
                <a href="{{ url('/myqualification') }}" class="btn btn-outline btn-lg">Cancel</a>
            </div>
        </div>
    </form>
</div>
@include('userdashboard-new.partials.form-page-styles')
@endsection
