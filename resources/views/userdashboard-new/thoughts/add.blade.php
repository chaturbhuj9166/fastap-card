@extends('layouts.redesign.dashboard')

@section('page-title', 'Add Thought')
@section('breadcrumb', 'Add Thought')

@section('dashboard-content')
<div class="form-page">
    <div class="page-header fade-up">
        <div class="page-header-content">
            <h1>Add Thought</h1>
            <p>Share an inspiring thought or quote</p>
        </div>
        <div class="page-header-actions">
            <a href="{{ url('/mythought') }}" class="btn btn-outline">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    <form action="{{ url('/savethought') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-card fade-up">
            <div class="form-card-header">
                <h3><i class="fas fa-lightbulb"></i> Your Thought</h3>
            </div>
            <div class="form-card-body">
                <div class="form-group">
                    <label for="thoughts">Thought / Quote <span class="required">*</span></label>
                    <textarea id="thoughts" name="thoughts" rows="6"
                              class="form-control @error('thoughts') is-invalid @enderror"
                              placeholder="Share your thought, insight, or favorite quote..." required>{{ old('thoughts') }}</textarea>
                    @error('thoughts')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                    <small class="form-hint">Express yourself - share wisdom, motivation, or personal insights.</small>
                </div>
            </div>
            <div class="form-card-footer">
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="fas fa-save"></i> Save Thought
                </button>
                <a href="{{ url('/mythought') }}" class="btn btn-outline btn-lg">Cancel</a>
            </div>
        </div>
    </form>
</div>
@include('userdashboard-new.partials.form-page-styles')
@endsection
