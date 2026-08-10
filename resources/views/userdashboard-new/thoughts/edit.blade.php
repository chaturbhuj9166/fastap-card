@extends('layouts.redesign.dashboard')

@section('page-title', 'Edit Thought')
@section('breadcrumb', 'Edit Thought')

@section('dashboard-content')
<div class="form-page">
    <div class="page-header fade-up">
        <div class="page-header-content">
            <h1>Edit Thought</h1>
            <p>Update your thought or quote</p>
        </div>
        <div class="page-header-actions">
            <a href="{{ url('/mythought') }}" class="btn btn-outline">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    <form action="{{ url('/updatethought') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{ $thought->id }}">
        <div class="form-card fade-up">
            <div class="form-card-header">
                <h3><i class="fas fa-lightbulb"></i> Your Thought</h3>
            </div>
            <div class="form-card-body">
                <div class="form-group">
                    <label for="thoughts">Thought / Quote <span class="required">*</span></label>
                    <textarea id="thoughts" name="thoughts" rows="6"
                              class="form-control @error('thoughts') is-invalid @enderror"
                              placeholder="Share your thought, insight, or favorite quote..." required>{{ old('thoughts', $thought->thought) }}</textarea>
                    @error('thoughts')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                    <small class="form-hint">Express yourself - share wisdom, motivation, or personal insights.</small>
                </div>
            </div>
            <div class="form-card-footer">
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="fas fa-save"></i> Update Thought
                </button>
                <a href="{{ url('/mythought') }}" class="btn btn-outline btn-lg">Cancel</a>
            </div>
        </div>
    </form>
</div>
@include('userdashboard-new.partials.form-page-styles')
@endsection
