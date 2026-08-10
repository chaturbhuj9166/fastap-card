<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $theme->name ?? 'Theme' }} Preview</title>

    <!-- Include all necessary CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        /* Scale down for preview mode */
        @media (min-width: 768px) {
            body.preview-mode {
                transform: scale(0.6);
                transform-origin: top left;
                width: 166.67%; /* 100 / 0.6 */
            }
        }

        /* Hide elements not needed in preview */
        .preview-mode .download-btn,
        .preview-mode .share-btn,
        .preview-mode .save-contact-btn {
            pointer-events: none;
        }
    </style>
</head>
<body class="{{ isset($isLivePreview) && $isLivePreview ? 'preview-mode' : '' }}">

    @php
        $viewPath = 'frontend.profile-themes.' . ($theme->view_template ?? 'default');
    @endphp

    @if(view()->exists($viewPath))
        @include($viewPath)
    @else
        <div style="padding: 40px; text-align: center;">
            <h3>Theme template not found</h3>
            <p>The theme template "{{ $theme->view_template ?? 'unknown' }}" does not exist.</p>
            <p>Looking for: {{ $viewPath }}</p>
        </div>
    @endif

    <!-- Include necessary JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Disable form submissions and external links in preview mode
        document.addEventListener('DOMContentLoaded', function() {
            const isPreview = {{ isset($isLivePreview) && $isLivePreview ? 'true' : (isset($isPreview) && $isPreview ? 'true' : 'false') }};

            if (isPreview) {
                // Prevent form submissions
                document.querySelectorAll('form').forEach(form => {
                    form.addEventListener('submit', function(e) {
                        e.preventDefault();
                        return false;
                    });
                });

                // Prevent navigation on links (except anchors)
                document.querySelectorAll('a').forEach(link => {
                    const href = link.getAttribute('href');
                    if (href && !href.startsWith('#')) {
                        link.addEventListener('click', function(e) {
                            e.preventDefault();
                            return false;
                        });
                    }
                });
            }
        });
    </script>
@include('components.profile-location-tracker', ['customerId' => $userdata->id ?? null, 'profileSlug' => $userdata->slug ?? null, 'isPreview' => $isPreview ?? false])
</body>
</html>
