@extends('layouts.redesign.app')

@section('content')
    <!-- Header -->
    @include('layouts.redesign.partials.header')

    <!-- Main Content -->
    <main>
        @yield('main')
    </main>

    <!-- Footer -->
    @include('layouts.redesign.partials.footer')

    <!-- WhatsApp Button -->
    @include('layouts.redesign.partials.whatsapp')
@endsection

@push('styles')
    <style>
        main {
            min-height: calc(100vh - 80px);
        }
    </style>
@endpush
