@extends('layouts.redesign.dashboard')

@section('page-title', 'My QR Code')
@section('breadcrumb', 'QR Code')

@section('dashboard-content')
<div class="qrcode-page">
    {{-- Page Header --}}
    <div class="page-header fade-up">
        <div class="page-header-content">
            <h1>My QR Code</h1>
            <p>Share your digital profile instantly with a scan</p>
        </div>
        <div class="page-header-actions">
            <a href="{{ url('/'.$user->slug) }}" class="btn btn-outline" target="_blank">
                <i class="fas fa-external-link-alt"></i> View Profile
            </a>
        </div>
    </div>

    <div class="qrcode-layout">
        {{-- QR Code Display --}}
        <div class="qrcode-card fade-up">
            <div class="qrcode-card-header">
                <h3><i class="fas fa-qrcode"></i> Your QR Code</h3>
            </div>
            <div class="qrcode-card-body">
                <div class="qrcode-display">
                    <div class="qrcode-frame">
                        <img id="qr-code" src="" alt="QR Code" crossorigin="anonymous">
                        <canvas id="img-canvas" class="d-none" width="300" height="300"></canvas>
                    </div>
                    <p class="qrcode-label">Scan to view profile</p>
                </div>

                @php
                    $profileUrl = url('/'.$user->slug);
                    $qrProfileUrl = $profileUrl . '?src=qr';
                    $nfcProfileUrl = $profileUrl . '?src=nfc';
                @endphp
                <input type="hidden" id="profile-url" value="{{ $profileUrl }}">
                <input type="hidden" id="qr-profile-url" value="{{ $qrProfileUrl }}">
                <input type="hidden" id="nfc-profile-url" value="{{ $nfcProfileUrl }}">

                <div class="qrcode-actions">
                    <button type="button" class="btn btn-primary" id="download-btn">
                        <i class="fas fa-download"></i> Download PNG
                    </button>
                    <button type="button" class="btn btn-outline" id="copy-link-btn">
                        <i class="fas fa-copy"></i> Copy Link
                    </button>
                </div>
            </div>
        </div>

        {{-- Profile Info --}}
        <div class="qrcode-info fade-up">
            <div class="info-card">
                <div class="info-card-header">
                    <h3><i class="fas fa-link"></i> Profile Link</h3>
                </div>
                <div class="info-card-body">
                    <div class="profile-url-display">
                        <code id="profile-url-text">{{ $qrProfileUrl }}</code>
                        <button type="button" class="btn btn-sm btn-icon" id="copy-url-btn" title="Copy URL">
                            <i class="fas fa-copy"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="info-card">
                <div class="info-card-header">
                    <h3><i class="fas fa-wifi"></i> NFC Tag Link</h3>
                </div>
                <div class="info-card-body">
                    <div class="profile-url-display">
                        <code id="nfc-url-text">{{ $nfcProfileUrl }}</code>
                        <button type="button" class="btn btn-sm btn-icon" id="copy-nfc-btn" title="Copy NFC URL">
                            <i class="fas fa-copy"></i>
                        </button>
                    </div>
                    <p class="qrcode-label" style="text-align:left; margin-top:0.75rem;">
                        Use this link when programming NFC tags so taps are tracked correctly.
                    </p>
                </div>
            </div>

            <div class="info-card">
                <div class="info-card-header">
                    <h3><i class="fas fa-share-alt"></i> Share Options</h3>
                </div>
                <div class="info-card-body">
                    <div class="share-buttons">
                        <a href="https://wa.me/?text={{ urlencode('Check out my digital profile: ' . $profileUrl) }}"
                           class="share-btn whatsapp" target="_blank" title="Share on WhatsApp">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($profileUrl) }}"
                           class="share-btn facebook" target="_blank" title="Share on Facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode($profileUrl) }}&text={{ urlencode('Check out my digital profile!') }}"
                           class="share-btn twitter" target="_blank" title="Share on Twitter">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode($profileUrl) }}"
                           class="share-btn linkedin" target="_blank" title="Share on LinkedIn">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="mailto:?subject=Check out my digital profile&body={{ urlencode('View my digital business card: ' . $profileUrl) }}"
                           class="share-btn email" title="Share via Email">
                            <i class="fas fa-envelope"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="info-card tips-card">
                <div class="info-card-header">
                    <h3><i class="fas fa-lightbulb"></i> Quick Tips</h3>
                </div>
                <div class="info-card-body">
                    <ul class="tips-list">
                        <li><i class="fas fa-check-circle"></i> Print the QR code on your business cards</li>
                        <li><i class="fas fa-check-circle"></i> Add it to your email signature</li>
                        <li><i class="fas fa-check-circle"></i> Display at your workplace or events</li>
                        <li><i class="fas fa-check-circle"></i> Share on social media profiles</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.qrcode-page {
    padding: var(--space-lg);
}

/* Page Header */
.page-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: var(--space-xl);
    flex-wrap: wrap;
    gap: var(--space-md);
}

.page-header-content h1 {
    font-size: var(--text-2xl);
    font-weight: var(--font-bold);
    margin-bottom: var(--space-xs);
}

.page-header-content p {
    color: var(--text-secondary);
}

/* QR Code Layout */
.qrcode-layout {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: var(--space-xl);
}

/* QR Code Card */
.qrcode-card {
    background: var(--bg-primary);
    border: 1px solid var(--border-light);
    border-radius: var(--radius-2xl);
    overflow: hidden;
}

.qrcode-card-header {
    padding: var(--space-lg);
    border-bottom: 1px solid var(--border-light);
    background: var(--bg-secondary);
}

.qrcode-card-header h3 {
    font-size: var(--text-base);
    font-weight: var(--font-semibold);
    display: flex;
    align-items: center;
    gap: var(--space-sm);
    margin: 0;
}

.qrcode-card-header h3 i {
    color: var(--purple-500);
}

.qrcode-card-body {
    padding: var(--space-xl);
    display: flex;
    flex-direction: column;
    align-items: center;
}

.qrcode-display {
    text-align: center;
    margin-bottom: var(--space-xl);
}

.qrcode-frame {
    background: white;
    padding: var(--space-lg);
    border-radius: var(--radius-xl);
    box-shadow: var(--shadow-lg);
    display: inline-block;
    margin-bottom: var(--space-md);
}

.qrcode-frame img {
    width: 250px;
    height: 250px;
    display: block;
}

.qrcode-label {
    font-size: var(--text-sm);
    color: var(--text-secondary);
    margin: 0;
}

.qrcode-actions {
    display: flex;
    gap: var(--space-md);
    flex-wrap: wrap;
    justify-content: center;
}

/* Info Cards */
.qrcode-info {
    display: flex;
    flex-direction: column;
    gap: var(--space-lg);
}

.info-card {
    background: var(--bg-primary);
    border: 1px solid var(--border-light);
    border-radius: var(--radius-xl);
    overflow: hidden;
}

.info-card-header {
    padding: var(--space-md) var(--space-lg);
    border-bottom: 1px solid var(--border-light);
    background: var(--bg-secondary);
}

.info-card-header h3 {
    font-size: var(--text-sm);
    font-weight: var(--font-semibold);
    display: flex;
    align-items: center;
    gap: var(--space-sm);
    margin: 0;
}

.info-card-header h3 i {
    color: var(--purple-500);
}

.info-card-body {
    padding: var(--space-lg);
}

/* Profile URL Display */
.profile-url-display {
    display: flex;
    align-items: center;
    gap: var(--space-sm);
    background: var(--bg-secondary);
    padding: var(--space-sm) var(--space-md);
    border-radius: var(--radius-lg);
    border: 1px solid var(--border-light);
}

.profile-url-display code {
    flex: 1;
    font-size: var(--text-sm);
    color: var(--purple-600);
    word-break: break-all;
}

.btn-icon {
    width: 32px;
    height: 32px;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    background: var(--bg-primary);
    border: 1px solid var(--border-light);
    border-radius: var(--radius-md);
    color: var(--text-secondary);
    cursor: pointer;
    transition: all var(--transition-fast);
}

.btn-icon:hover {
    background: var(--purple-500);
    border-color: var(--purple-500);
    color: white;
}

/* Share Buttons */
.share-buttons {
    display: flex;
    gap: var(--space-sm);
    flex-wrap: wrap;
}

.share-btn {
    width: 44px;
    height: 44px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: var(--radius-lg);
    color: white;
    font-size: var(--text-lg);
    text-decoration: none;
    transition: all var(--transition-fast);
}

.share-btn:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
}

.share-btn.whatsapp { background: #25D366; }
.share-btn.facebook { background: #1877F2; }
.share-btn.twitter { background: #1DA1F2; }
.share-btn.linkedin { background: #0A66C2; }
.share-btn.email { background: var(--purple-500); }

/* Tips Card */
.tips-card {
    background: linear-gradient(135deg, rgba(139, 92, 246, 0.05) 0%, rgba(168, 85, 247, 0.05) 100%);
    border-color: rgba(139, 92, 246, 0.2);
}

.tips-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.tips-list li {
    display: flex;
    align-items: center;
    gap: var(--space-sm);
    padding: var(--space-sm) 0;
    font-size: var(--text-sm);
    color: var(--text-secondary);
}

.tips-list li i {
    color: var(--green-500);
    font-size: var(--text-xs);
}

/* Responsive */
@media (max-width: 992px) {
    .qrcode-layout {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 576px) {
    .qrcode-actions {
        flex-direction: column;
        width: 100%;
    }

    .qrcode-actions .btn {
        width: 100%;
        justify-content: center;
    }

    .qrcode-frame img {
        width: 200px;
        height: 200px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const profileUrl = document.getElementById('profile-url').value;
    const qrProfileUrl = document.getElementById('qr-profile-url').value;
    const nfcProfileUrl = document.getElementById('nfc-profile-url').value;
    const qrCodeImg = document.getElementById('qr-code');
    const canvasEl = document.getElementById('img-canvas');
    const ctx = canvasEl.getContext('2d');

    // Generate QR Code
    const qrApiUrl = 'https://quickchart.io/qr?text=' + encodeURIComponent(qrProfileUrl) + '&size=300';
    qrCodeImg.src = qrApiUrl;

    // Download QR Code
    document.getElementById('download-btn').addEventListener('click', function() {
        // Wait for image to load
        if (!qrCodeImg.complete) {
            alert('Please wait for QR code to load');
            return;
        }

        canvasEl.width = 300;
        canvasEl.height = 300;
        ctx.drawImage(qrCodeImg, 0, 0, 300, 300);

        const link = document.createElement('a');
        link.download = 'fastap-qrcode.png';
        link.href = canvasEl.toDataURL('image/png');
        link.click();
    });

    // Copy Link functionality
    function copyToClipboard(text, btn) {
        navigator.clipboard.writeText(text).then(function() {
            const originalHtml = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-check"></i> Copied!';
            btn.classList.add('btn-success');

            setTimeout(function() {
                btn.innerHTML = originalHtml;
                btn.classList.remove('btn-success');
            }, 2000);
        }).catch(function(err) {
            console.error('Could not copy text: ', err);
        });
    }

    document.getElementById('copy-link-btn').addEventListener('click', function() {
        copyToClipboard(qrProfileUrl, this);
    });

    document.getElementById('copy-url-btn').addEventListener('click', function() {
        copyToClipboard(qrProfileUrl, this);
    });

    document.getElementById('copy-nfc-btn').addEventListener('click', function() {
        copyToClipboard(nfcProfileUrl, this);
    });
});
</script>
@endsection
