@php
    $trackingCustomerId = $customerId ?? null;
    $trackingProfileSlug = $profileSlug ?? null;
    $trackingPreview = $isPreview ?? false;
@endphp

@if(!$trackingPreview && $trackingCustomerId && $trackingProfileSlug)
<script>
    (function () {
        const customerId = "{{ $trackingCustomerId }}";
        const profileSlug = "{{ $trackingProfileSlug }}";
        const trackKey = "fastap-location-tracked-" + profileSlug;

        if (sessionStorage.getItem(trackKey)) {
            return;
        }

        const params = new URLSearchParams(window.location.search);
        const tapSourceParam = (params.get("src") || params.get("source") || params.get("tap") || "").toLowerCase();
        const tapSource = ["nfc", "qr", "link"].includes(tapSourceParam) ? tapSourceParam : "unknown";

        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || "{{ csrf_token() }}";

        const sendTracking = (payload) => {
            fetch("{{ route('profile.location.track') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    ...(csrfToken ? { "X-CSRF-TOKEN": csrfToken } : {})
                },
                body: JSON.stringify(payload),
                keepalive: true
            }).then(() => {
                sessionStorage.setItem(trackKey, "1");
            }).catch(() => {
                // Silent fail to avoid blocking profile view
            });
        };

        const basePayload = {
            customer_id: customerId,
            profile_slug: profileSlug,
            tap_source: tapSource,
        };

        if (!("geolocation" in navigator)) {
            sendTracking({ ...basePayload, location_status: "unsupported" });
            return;
        }

        navigator.geolocation.getCurrentPosition(
            (position) => {
                sendTracking({
                    ...basePayload,
                    location_status: "granted",
                    latitude: position.coords.latitude,
                    longitude: position.coords.longitude,
                    accuracy_m: Math.round(position.coords.accuracy)
                });
            },
            (error) => {
                let status = "unknown";
                if (error.code === error.PERMISSION_DENIED) {
                    status = "denied";
                } else if (error.code === error.POSITION_UNAVAILABLE || error.code === error.TIMEOUT) {
                    status = "unavailable";
                }
                sendTracking({ ...basePayload, location_status: status });
            },
            {
                enableHighAccuracy: true,
                timeout: 6000,
                maximumAge: 60000
            }
        );
    })();
</script>
@endif
