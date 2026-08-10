<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Fastap') - Digital Business Cards</title>
    <meta name="description" content="@yield('description', 'Transform your networking with smart NFC digital business cards')">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('frontend/assets/img/logo/favicon.png') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Design System CSS -->
    <link rel="stylesheet" href="{{ asset('redesign/css/variables.css') }}">
    <link rel="stylesheet" href="{{ asset('redesign/css/base.css') }}">
    <link rel="stylesheet" href="{{ asset('redesign/css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('redesign/css/theme-toggle.css') }}">
    <link rel="stylesheet" href="{{ asset('redesign/css/animations.css') }}">

    <!-- Page Specific CSS -->
    @stack('styles')
</head>
<body>
    <!-- Theme transition helper -->
    <script>
        // Apply saved theme before page renders to prevent flash
        (function() {
            const theme = localStorage.getItem('fastap-theme') || 'light';
            document.documentElement.setAttribute('data-theme', theme);
        })();
    </script>

    @yield('content')

    <!-- Core Scripts -->
    <script src="{{ asset('redesign/js/theme-toggle.js') }}"></script>
    <script src="{{ asset('redesign/js/animations.js') }}"></script>

    <!-- Page Specific Scripts -->
    @stack('scripts')
</body>
</html>
