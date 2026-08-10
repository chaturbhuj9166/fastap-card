@extends('layouts.redesign.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('redesign/css/dashboard.css') }}">
@endpush

@section('content')
    <div class="dashboard-wrapper">
        <!-- Sidebar -->
        @include('layouts.redesign.partials.sidebar')

        <!-- Main Content Area -->
        <div class="dashboard-main">
            <!-- Top Header -->
            @include('layouts.redesign.partials.dashboard-header')

            <!-- Dashboard Content -->
            <div class="dashboard-content">
                <!-- Flash Messages -->
                @include('layouts.redesign.partials.flash-messages')

                <!-- Page Content -->
                @yield('dashboard-content')
            </div>
        </div>
    </div>

    <!-- Modal Backdrop (for all modals) -->
    <div class="modal-backdrop"></div>
@endsection

@push('scripts')
    <script src="{{ asset('redesign/js/dashboard.js') }}"></script>
@endpush
