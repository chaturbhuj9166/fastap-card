@php
    $profileUrl = url()->current();
    $profileName = $userdata->name ?? 'Fastap';
    $profilePhoneRaw = $userdata->whatsapp ?? $userdata->phone ?? $userdata->mobile ?? $userdata->contact ?? ($social->whatsapp ?? '');
    $profilePhone = preg_replace('/\D+/', '', $profilePhoneRaw);
    $profileSlug = $userdata->slug ?? '';
    $pdfRequestUrl = $profileSlug ? url('profile-pdf/request/' . $profileSlug) : null;
    $pdfStatusUrl = url('profile-pdf/status');
    $pdfDownloadUrl = url('profile-pdf/download');
    $whatsappMessage = urlencode("Hi {$profileName}, I found your Fastap profile: {$profileUrl}");
@endphp

@if(!($isPreview ?? false) && !($isPdf ?? false))
<div class="fastap-top-actions" role="region" aria-label="Profile quick actions"
     data-customer-id="{{ $userdata->id ?? '' }}"
     data-track-url="{{ url('profile-engagement') }}"
     data-csrf="{{ csrf_token() }}">
    <button type="button" class="fastap-top-action" data-action="copy" data-link="{{ $profileUrl }}">
        <i class="fas fa-link"></i> Copy Profile Link
    </button>
    <button type="button" class="fastap-top-action" data-action="pdf" data-request-url="{{ $pdfRequestUrl }}" data-status-url="{{ $pdfStatusUrl }}" data-download-url="{{ $pdfDownloadUrl }}">
        <i class="fas fa-file-pdf"></i> Download Profile PDF
    </button>
    <button type="button" class="fastap-top-action" data-action="vcard" data-name="{{ $profileName }}" data-phone="{{ $profilePhone }}">
        <i class="fas fa-address-card"></i> Save Contact
    </button>
</div>
@endif

@if(!empty($profilePhone) && !($isPreview ?? false) && !($isPdf ?? false))
<div class="profile-whatsapp-float">
    <a href="https://wa.me/{{ $profilePhone }}?text={{ $whatsappMessage }}"
       class="profile-whatsapp-button"
       target="_blank"
       rel="noopener noreferrer"
       aria-label="Chat on WhatsApp">
        <i class="fab fa-whatsapp"></i>
    </a>
</div>
@endif

<style>
    .fastap-top-actions {
        position: sticky;
        top: 0;
        z-index: 1100;
        display: flex;
        justify-content: center;
        gap: 0.5rem;
        padding: 0.75rem;
        background: rgba(15, 23, 42, 0.92);
        border-bottom: 1px solid rgba(255, 255, 255, 0.12);
        flex-wrap: wrap;
    }
    .fastap-top-action {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.55rem 0.9rem;
        border-radius: 0.5rem;
        border: 1px solid rgba(255, 255, 255, 0.2);
        background: rgba(255, 255, 255, 0.12);
        color: #ffffff;
        font-size: 0.8rem;
        font-weight: 600;
        text-decoration: none;
        cursor: pointer;
        transition: background 0.2s ease, border-color 0.2s ease;
    }
    .fastap-top-action:hover {
        background: rgba(255, 255, 255, 0.2);
        border-color: rgba(255, 255, 255, 0.35);
    }
    .fastap-top-action i { font-size: 0.9rem; }
    .fastap-toast {
        position: fixed;
        bottom: 1.5rem;
        right: 1.5rem;
        background: rgba(15, 23, 42, 0.95);
        color: #ffffff;
        padding: 0.75rem 1rem;
        border-radius: 0.6rem;
        font-size: 0.85rem;
        box-shadow: 0 12px 24px rgba(15, 23, 42, 0.25);
        z-index: 2000;
        opacity: 0;
        transform: translateY(10px);
        transition: opacity 0.2s ease, transform 0.2s ease;
    }
    .fastap-toast.show {
        opacity: 1;
        transform: translateY(0);
    }
    @media (max-width: 640px) {
        .fastap-top-action { flex: 1 1 auto; justify-content: center; }
        .fastap-toast { left: 1rem; right: 1rem; bottom: 1rem; }
    }
</style>

<style>
.profile-whatsapp-float {
    position: fixed;
    bottom: 24px;
    right: 24px;
    z-index: 1200;
}
.profile-whatsapp-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 56px;
    height: 56px;
    border-radius: 50%;
    background: linear-gradient(135deg, #25D366 0%, #128C7E 100%);
    color: #ffffff;
    font-size: 26px;
    box-shadow: 0 10px 22px rgba(18, 140, 126, 0.35);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.profile-whatsapp-button:hover {
    transform: translateY(-2px) scale(1.03);
    box-shadow: 0 14px 26px rgba(18, 140, 126, 0.45);
}
@media (max-width: 640px) {
    .profile-whatsapp-float {
        bottom: 18px;
        right: 18px;
    }
    .profile-whatsapp-button {
        width: 52px;
        height: 52px;
        font-size: 24px;
    }
}
</style>

<script>
    (function () {
        const actionsRoot = document.querySelector('.fastap-top-actions');
        const engagementConfig = actionsRoot
            ? {
                customerId: actionsRoot.dataset.customerId,
                trackUrl: actionsRoot.dataset.trackUrl,
                csrf: actionsRoot.dataset.csrf
            }
            : null;
        const isPreview = {{ ($isPreview ?? false) ? 'true' : 'false' }};
        const isPdf = {{ ($isPdf ?? false) ? 'true' : 'false' }};

        const trackEngagement = (action, source) => {
            if (!engagementConfig || !engagementConfig.customerId || !engagementConfig.trackUrl) {
                return;
            }
            if (isPreview || isPdf) {
                return;
            }

            const formData = new FormData();
            formData.append('customer_id', engagementConfig.customerId);
            formData.append('action', action);
            if (source) {
                formData.append('source', source);
            }
            formData.append('_token', engagementConfig.csrf);

            if (navigator.sendBeacon) {
                navigator.sendBeacon(engagementConfig.trackUrl, formData);
                return;
            }

            fetch(engagementConfig.trackUrl, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': engagementConfig.csrf
                },
                body: formData
            }).catch(() => {});
        };

        const message = "{{ $whatsappMessage }}";
        const showToast = (text) => {
            const existing = document.querySelector('.fastap-toast');
            if (existing) {
                existing.remove();
            }
            const toast = document.createElement('div');
            toast.className = 'fastap-toast';
            toast.textContent = text;
            document.body.appendChild(toast);
            requestAnimationFrame(() => toast.classList.add('show'));
            setTimeout(() => {
                toast.classList.remove('show');
                setTimeout(() => toast.remove(), 200);
            }, 2200);
        };
        const updateWhatsappLinks = () => {
            if (!message) return;
            document.querySelectorAll('a[href^=\"https://wa.me/\"]').forEach((link) => {
                if (link.href.includes('text=')) return;
                const sep = link.href.includes('?') ? '&' : '?';
                link.href = link.href + sep + 'text=' + message;
            });
        };
        const handleReady = () => {
            updateWhatsappLinks();
            trackEngagement('view', 'profile');
        };
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', handleReady);
        } else {
            handleReady();
        }

        document.addEventListener('click', (event) => {
            const actionEl = event.target.closest('.fastap-top-action[data-action]');
            if (!actionEl) return;

            const action = actionEl.dataset.action;
            if (action === 'share') {
                trackEngagement('share', actionEl.dataset.source || 'share');
            }
            if (action === 'copy') {
                const link = actionEl.dataset.link;
                if (!link) return;
                if (navigator.clipboard && navigator.clipboard.writeText) {
                    navigator.clipboard.writeText(link).then(() => {
                        actionEl.textContent = 'Link Copied';
                        trackEngagement('share', 'copy_link');
                        setTimeout(() => {
                            actionEl.innerHTML = '<i class="fas fa-link"></i> Copy Profile Link';
                        }, 1500);
                    });
                } else {
                    const temp = document.createElement('input');
                    temp.value = link;
                    document.body.appendChild(temp);
                    temp.select();
                    document.execCommand('copy');
                    temp.remove();
                    alert('Profile link copied.');
                    trackEngagement('share', 'copy_link');
                }
            }

            if (action === 'pdf-unavailable') {
                alert('Profile PDF is not available yet.');
            }

            if (action === 'pdf') {
                const requestUrl = actionEl.dataset.requestUrl;
                const statusBase = actionEl.dataset.statusUrl;
                const downloadBase = actionEl.dataset.downloadUrl;
                if (!requestUrl) {
                    alert('Profile PDF is not available yet.');
                    return;
                }

                actionEl.disabled = true;
                actionEl.textContent = 'Preparing PDF...';
                showToast('PDF is being prepared. Please wait...');

                fetch(requestUrl)
                    .then((response) => response.json())
                    .then((data) => {
                        if (!data || !data.job_id) {
                            throw new Error('Failed to queue PDF.');
                        }

                        const jobId = data.job_id;
                        const poll = () => {
                            fetch(statusBase + '/' + jobId)
                                .then((resp) => resp.json())
                                .then((status) => {
                                    if (status.status === 'ready' && status.download_url) {
                                        window.location.href = status.download_url;
                                        actionEl.disabled = false;
                                        actionEl.innerHTML = '<i class="fas fa-file-pdf"></i> Download Profile PDF';
                                        return;
                                    }
                                    if (status.status === 'failed') {
                                        actionEl.disabled = false;
                                        actionEl.innerHTML = '<i class="fas fa-file-pdf"></i> Download Profile PDF';
                                        alert(status.error || 'PDF generation failed.');
                                        return;
                                    }
                                    setTimeout(poll, 2000);
                                })
                                .catch(() => {
                                    actionEl.disabled = false;
                                    actionEl.innerHTML = '<i class="fas fa-file-pdf"></i> Download Profile PDF';
                                    alert('Unable to check PDF status.');
                                });
                        };
                        poll();
                    })
                    .catch(() => {
                        actionEl.disabled = false;
                        actionEl.innerHTML = '<i class="fas fa-file-pdf"></i> Download Profile PDF';
                        alert('Unable to start PDF generation.');
                    });
            }

            if (action === 'vcard') {
                const name = actionEl.dataset.name || 'Fastap';
                const phone = actionEl.dataset.phone || '';
                if (!phone) {
                    alert('Contact number is not available.');
                    return;
                }
                const vcard = [
                    'BEGIN:VCARD',
                    'VERSION:3.0',
                    'FN:' + name,
                    'TEL;TYPE=CELL:' + phone,
                    'END:VCARD'
                ].join('\\n');
                const blob = new Blob([vcard], { type: 'text/vcard' });
                const url = URL.createObjectURL(blob);
                const anchor = document.createElement('a');
                anchor.href = url;
                anchor.download = name.replace(/\\s+/g, '_') + '.vcf';
                document.body.appendChild(anchor);
                anchor.click();
                anchor.remove();
                setTimeout(() => URL.revokeObjectURL(url), 1000);
                trackEngagement('contact_save', 'vcard');
            }
        });
    })();
</script>
