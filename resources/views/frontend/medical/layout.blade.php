<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Medical Profile')</title>
    <link href="{{ URL::asset('frontend/profile_assets/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('frontend/profile_assets/assets/css/all.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('frontend/profile_assets/assets/css/responsive.css') }}" rel="stylesheet">
    <style>
        body {
            background: #f8fafc;
        }
    </style>
    @stack('styles')
</head>
<body>
    <div class="container py-4">
        @yield('content')
    </div>

    <script src="{{ URL::asset('frontend/profile_assets/assets/js/bootstrap.bundle.min.js') }}"></script>
    @stack('scripts')
</body>
</html>
