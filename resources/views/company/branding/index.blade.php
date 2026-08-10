@extends('layouts.redesign.company')

@section('page-title', 'Branding Settings')
@section('breadcrumb', 'Branding')

@section('company-content')
<div class="branding-page">
    <div class="page-header">
        <div>
            <h1><i class="fas fa-palette"></i> Branding Settings</h1>
            <p>Customize the look and feel of your staff cards</p>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
    </div>
    @endif

    <div class="branding-content">
        <div class="branding-main">
            <!-- Color Scheme -->
            <div class="form-card">
                <div class="card-header">
                    <h3><i class="fas fa-tint"></i> Color Scheme</h3>
                    <p>Choose colors that represent your brand</p>
                </div>
                <form action="{{ route('company.branding.colors') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="color-grid">
                            <div class="color-item">
                                <label class="color-label">Primary Color</label>
                                <div class="color-input-group">
                                    <input type="color" name="primary_color" class="color-picker"
                                           value="{{ $branding['primary_color'] ?? '#0891b2' }}">
                                    <input type="text" class="color-text"
                                           value="{{ $branding['primary_color'] ?? '#0891b2' }}" readonly>
                                </div>
                                <small>Used for buttons, links, and accents</small>
                            </div>
                            <div class="color-item">
                                <label class="color-label">Secondary Color</label>
                                <div class="color-input-group">
                                    <input type="color" name="secondary_color" class="color-picker"
                                           value="{{ $branding['secondary_color'] ?? '#06b6d4' }}">
                                    <input type="text" class="color-text"
                                           value="{{ $branding['secondary_color'] ?? '#06b6d4' }}" readonly>
                                </div>
                                <small>Used for secondary elements</small>
                            </div>
                            <div class="color-item">
                                <label class="color-label">Accent Color</label>
                                <div class="color-input-group">
                                    <input type="color" name="accent_color" class="color-picker"
                                           value="{{ $branding['accent_color'] ?? '#f59e0b' }}">
                                    <input type="text" class="color-text"
                                           value="{{ $branding['accent_color'] ?? '#f59e0b' }}" readonly>
                                </div>
                                <small>Used for highlights and CTAs</small>
                            </div>
                            <div class="color-item">
                                <label class="color-label">Text Color</label>
                                <div class="color-input-group">
                                    <input type="color" name="text_color" class="color-picker"
                                           value="{{ $branding['text_color'] ?? '#1f2937' }}">
                                    <input type="text" class="color-text"
                                           value="{{ $branding['text_color'] ?? '#1f2937' }}" readonly>
                                </div>
                                <small>Primary text color</small>
                            </div>
                        </div>

                        <div class="preset-colors">
                            <label class="color-label">Quick Presets</label>
                            <div class="preset-list">
                                <button type="button" class="preset-btn" data-primary="#0891b2" data-secondary="#06b6d4" data-accent="#f59e0b">
                                    <span style="background: #0891b2"></span> Cyan
                                </button>
                                <button type="button" class="preset-btn" data-primary="#7c3aed" data-secondary="#8b5cf6" data-accent="#fbbf24">
                                    <span style="background: #7c3aed"></span> Purple
                                </button>
                                <button type="button" class="preset-btn" data-primary="#059669" data-secondary="#10b981" data-accent="#f59e0b">
                                    <span style="background: #059669"></span> Green
                                </button>
                                <button type="button" class="preset-btn" data-primary="#dc2626" data-secondary="#ef4444" data-accent="#fbbf24">
                                    <span style="background: #dc2626"></span> Red
                                </button>
                                <button type="button" class="preset-btn" data-primary="#2563eb" data-secondary="#3b82f6" data-accent="#f59e0b">
                                    <span style="background: #2563eb"></span> Blue
                                </button>
                                <button type="button" class="preset-btn" data-primary="#d97706" data-secondary="#f59e0b" data-accent="#0891b2">
                                    <span style="background: #d97706"></span> Orange
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Save Colors
                        </button>
                    </div>
                </form>
            </div>

            <!-- Typography -->
            <div class="form-card">
                <div class="card-header">
                    <h3><i class="fas fa-font"></i> Typography</h3>
                    <p>Choose fonts for your cards</p>
                </div>
                <form action="{{ route('company.branding.typography') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Heading Font</label>
                                <select name="heading_font" class="form-select font-select" data-preview="heading-preview">
                                    <option value="Inter" {{ ($branding['heading_font'] ?? 'Inter') == 'Inter' ? 'selected' : '' }}>Inter</option>
                                    <option value="Poppins" {{ ($branding['heading_font'] ?? '') == 'Poppins' ? 'selected' : '' }}>Poppins</option>
                                    <option value="Montserrat" {{ ($branding['heading_font'] ?? '') == 'Montserrat' ? 'selected' : '' }}>Montserrat</option>
                                    <option value="Playfair Display" {{ ($branding['heading_font'] ?? '') == 'Playfair Display' ? 'selected' : '' }}>Playfair Display</option>
                                    <option value="Roboto" {{ ($branding['heading_font'] ?? '') == 'Roboto' ? 'selected' : '' }}>Roboto</option>
                                    <option value="Open Sans" {{ ($branding['heading_font'] ?? '') == 'Open Sans' ? 'selected' : '' }}>Open Sans</option>
                                </select>
                                <p id="heading-preview" class="font-preview" style="font-family: {{ $branding['heading_font'] ?? 'Inter' }}">
                                    Company Name Preview
                                </p>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Body Font</label>
                                <select name="body_font" class="form-select font-select" data-preview="body-preview">
                                    <option value="Inter" {{ ($branding['body_font'] ?? 'Inter') == 'Inter' ? 'selected' : '' }}>Inter</option>
                                    <option value="Poppins" {{ ($branding['body_font'] ?? '') == 'Poppins' ? 'selected' : '' }}>Poppins</option>
                                    <option value="Roboto" {{ ($branding['body_font'] ?? '') == 'Roboto' ? 'selected' : '' }}>Roboto</option>
                                    <option value="Open Sans" {{ ($branding['body_font'] ?? '') == 'Open Sans' ? 'selected' : '' }}>Open Sans</option>
                                    <option value="Lato" {{ ($branding['body_font'] ?? '') == 'Lato' ? 'selected' : '' }}>Lato</option>
                                    <option value="Source Sans Pro" {{ ($branding['body_font'] ?? '') == 'Source Sans Pro' ? 'selected' : '' }}>Source Sans Pro</option>
                                </select>
                                <p id="body-preview" class="font-preview body-font" style="font-family: {{ $branding['body_font'] ?? 'Inter' }}">
                                    This is how body text will appear on your cards.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Save Typography
                        </button>
                    </div>
                </form>
            </div>

            <!-- Card Layout -->
            <div class="form-card">
                <div class="card-header">
                    <h3><i class="fas fa-th-large"></i> Card Layout</h3>
                    <p>Choose how staff cards are displayed</p>
                </div>
                <form action="{{ route('company.branding.layout') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="layout-options">
                            <label class="layout-option">
                                <input type="radio" name="card_layout" value="modern"
                                       {{ ($branding['card_layout'] ?? 'modern') == 'modern' ? 'checked' : '' }}>
                                <div class="layout-preview modern">
                                    <div class="preview-header"></div>
                                    <div class="preview-avatar"></div>
                                    <div class="preview-info"></div>
                                </div>
                                <span>Modern</span>
                            </label>
                            <label class="layout-option">
                                <input type="radio" name="card_layout" value="classic"
                                       {{ ($branding['card_layout'] ?? '') == 'classic' ? 'checked' : '' }}>
                                <div class="layout-preview classic">
                                    <div class="preview-avatar"></div>
                                    <div class="preview-info"></div>
                                </div>
                                <span>Classic</span>
                            </label>
                            <label class="layout-option">
                                <input type="radio" name="card_layout" value="minimal"
                                       {{ ($branding['card_layout'] ?? '') == 'minimal' ? 'checked' : '' }}>
                                <div class="layout-preview minimal">
                                    <div class="preview-info"></div>
                                </div>
                                <span>Minimal</span>
                            </label>
                        </div>

                        <div class="form-group" style="margin-top: 1.5rem;">
                            <label class="form-label">Button Style</label>
                            <div class="button-styles">
                                <label class="button-style-option">
                                    <input type="radio" name="button_style" value="rounded"
                                           {{ ($branding['button_style'] ?? 'rounded') == 'rounded' ? 'checked' : '' }}>
                                    <span class="btn-preview rounded">Button</span>
                                </label>
                                <label class="button-style-option">
                                    <input type="radio" name="button_style" value="pill"
                                           {{ ($branding['button_style'] ?? '') == 'pill' ? 'checked' : '' }}>
                                    <span class="btn-preview pill">Button</span>
                                </label>
                                <label class="button-style-option">
                                    <input type="radio" name="button_style" value="square"
                                           {{ ($branding['button_style'] ?? '') == 'square' ? 'checked' : '' }}>
                                    <span class="btn-preview square">Button</span>
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="toggle-option">
                                <input type="checkbox" name="show_company_logo" value="1"
                                       {{ ($branding['show_company_logo'] ?? true) ? 'checked' : '' }}>
                                <span class="toggle-switch"></span>
                                <span class="toggle-label">Show company logo on staff cards</span>
                            </label>
                        </div>

                        <div class="form-group">
                            <label class="toggle-option">
                                <input type="checkbox" name="show_company_name" value="1"
                                       {{ ($branding['show_company_name'] ?? true) ? 'checked' : '' }}>
                                <span class="toggle-switch"></span>
                                <span class="toggle-label">Show company name on staff cards</span>
                            </label>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Save Layout
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Preview Sidebar -->
        <div class="branding-sidebar">
            <div class="preview-card">
                <h4><i class="fas fa-eye"></i> Live Preview</h4>
                <div class="card-preview" id="cardPreview">
                    <div class="preview-header-band" id="previewHeader"></div>
                    <div class="preview-content">
                        <div class="preview-logo">
                            @if($company->logo)
                                <img src="{{ asset('uploads/companies/' . $company->logo) }}" alt="">
                            @else
                                <span>{{ substr($company->name, 0, 1) }}</span>
                            @endif
                        </div>
                        <h3 class="preview-name" id="previewName">John Doe</h3>
                        <p class="preview-title">Software Engineer</p>
                        <p class="preview-company">{{ $company->name }}</p>
                        <div class="preview-buttons">
                            <button class="preview-btn-primary" id="previewBtn">Contact</button>
                        </div>
                    </div>
                </div>
                <p class="preview-note">This is a simplified preview. Actual cards may vary.</p>
            </div>
        </div>
    </div>
</div>

@push('page-styles')
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@400;500;600;700&family=Montserrat:wght@400;500;600;700&family=Playfair+Display:wght@400;500;600;700&family=Roboto:wght@400;500;700&family=Open+Sans:wght@400;500;600;700&family=Lato:wght@400;700&family=Source+Sans+Pro:wght@400;600;700&display=swap" rel="stylesheet">
<style>
    .branding-page { max-width: 1200px; }
    .page-header { margin-bottom: 1.5rem; }
    .page-header h1 {
        font-size: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 0.25rem;
    }
    .page-header p { color: var(--text-muted); }

    .alert {
        padding: 1rem;
        border-radius: 0.75rem;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    .alert-success { background: #d1fae5; color: #065f46; }

    .branding-content {
        display: grid;
        grid-template-columns: 1fr 320px;
        gap: 1.5rem;
    }
    @media (max-width: 968px) { .branding-content { grid-template-columns: 1fr; } }

    .form-card {
        background: var(--bg-primary);
        border-radius: 1rem;
        box-shadow: var(--shadow-sm);
        margin-bottom: 1.5rem;
    }
    .card-header {
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid var(--border-color);
    }
    .card-header h3 {
        font-size: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 0.25rem;
    }
    .card-header p { color: var(--text-muted); font-size: 0.875rem; }
    .card-body { padding: 1.5rem; }
    .card-footer {
        padding: 1rem 1.5rem;
        border-top: 1px solid var(--border-color);
        display: flex;
        justify-content: flex-end;
    }

    .color-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.25rem;
    }
    @media (max-width: 480px) { .color-grid { grid-template-columns: 1fr; } }

    .color-item { margin-bottom: 0.5rem; }
    .color-label {
        display: block;
        font-weight: 500;
        margin-bottom: 0.5rem;
    }
    .color-input-group {
        display: flex;
        gap: 0.5rem;
        align-items: center;
    }
    .color-picker {
        width: 50px;
        height: 40px;
        border: 2px solid var(--border-color);
        border-radius: 0.5rem;
        cursor: pointer;
        padding: 2px;
    }
    .color-text {
        flex: 1;
        padding: 0.5rem 0.75rem;
        border: 2px solid var(--border-color);
        border-radius: 0.5rem;
        font-family: monospace;
        background: var(--bg-secondary);
    }
    .color-item small {
        color: var(--text-muted);
        font-size: 0.8rem;
        margin-top: 0.25rem;
        display: block;
    }

    .preset-colors { margin-top: 1.5rem; }
    .preset-list {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-top: 0.5rem;
    }
    .preset-btn {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        border: 2px solid var(--border-color);
        border-radius: 0.5rem;
        background: var(--bg-primary);
        cursor: pointer;
        transition: all 0.2s;
    }
    .preset-btn:hover { border-color: #0891b2; }
    .preset-btn span {
        width: 16px;
        height: 16px;
        border-radius: 50%;
    }

    .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
    @media (max-width: 480px) { .form-row { grid-template-columns: 1fr; } }
    .form-group { margin-bottom: 1rem; }
    .form-label { display: block; font-weight: 500; margin-bottom: 0.5rem; }
    .form-select {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 2px solid var(--border-color);
        border-radius: 0.5rem;
        background: var(--bg-primary);
        color: var(--text-primary);
    }
    .font-preview {
        margin-top: 0.75rem;
        padding: 1rem;
        background: var(--bg-secondary);
        border-radius: 0.5rem;
        font-size: 1.25rem;
    }
    .font-preview.body-font { font-size: 0.95rem; }

    .layout-options {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1rem;
    }
    @media (max-width: 480px) { .layout-options { grid-template-columns: 1fr; } }
    .layout-option {
        cursor: pointer;
        text-align: center;
    }
    .layout-option input { display: none; }
    .layout-preview {
        border: 2px solid var(--border-color);
        border-radius: 0.75rem;
        padding: 1rem;
        height: 120px;
        transition: all 0.2s;
        background: var(--bg-secondary);
    }
    .layout-option input:checked + .layout-preview {
        border-color: #0891b2;
        box-shadow: 0 0 0 3px rgba(8, 145, 178, 0.1);
    }
    .layout-preview .preview-header {
        height: 30px;
        background: linear-gradient(135deg, #0891b2, #06b6d4);
        border-radius: 0.25rem;
        margin-bottom: 0.5rem;
    }
    .layout-preview .preview-avatar {
        width: 40px;
        height: 40px;
        background: var(--border-color);
        border-radius: 50%;
        margin: 0 auto 0.5rem;
    }
    .layout-preview .preview-info {
        height: 20px;
        background: var(--border-color);
        border-radius: 0.25rem;
    }
    .layout-preview.classic .preview-avatar { margin-top: 0.5rem; }
    .layout-preview.minimal { display: flex; align-items: center; justify-content: center; }
    .layout-option span {
        display: block;
        margin-top: 0.5rem;
        font-weight: 500;
    }

    .button-styles {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
    }
    .button-style-option { cursor: pointer; }
    .button-style-option input { display: none; }
    .btn-preview {
        display: inline-block;
        padding: 0.5rem 1.5rem;
        background: #0891b2;
        color: white;
        font-size: 0.875rem;
        border: 2px solid transparent;
        transition: all 0.2s;
    }
    .btn-preview.rounded { border-radius: 0.5rem; }
    .btn-preview.pill { border-radius: 2rem; }
    .btn-preview.square { border-radius: 0; }
    .button-style-option input:checked + .btn-preview {
        box-shadow: 0 0 0 3px rgba(8, 145, 178, 0.3);
    }

    .toggle-option {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        cursor: pointer;
        padding: 0.75rem 0;
    }
    .toggle-option input { display: none; }
    .toggle-switch {
        width: 44px;
        height: 24px;
        background: var(--border-color);
        border-radius: 12px;
        position: relative;
        transition: background 0.2s;
    }
    .toggle-switch::after {
        content: '';
        position: absolute;
        top: 2px;
        left: 2px;
        width: 20px;
        height: 20px;
        background: white;
        border-radius: 50%;
        transition: transform 0.2s;
    }
    .toggle-option input:checked + .toggle-switch {
        background: #0891b2;
    }
    .toggle-option input:checked + .toggle-switch::after {
        transform: translateX(20px);
    }
    .toggle-label { font-weight: 500; }

    /* Preview Sidebar */
    .branding-sidebar { position: sticky; top: 1rem; }
    .preview-card {
        background: var(--bg-primary);
        border-radius: 1rem;
        padding: 1.25rem;
        box-shadow: var(--shadow-sm);
    }
    .preview-card h4 {
        font-size: 0.95rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 1rem;
    }
    .card-preview {
        background: white;
        border-radius: 1rem;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }
    .preview-header-band {
        height: 80px;
        background: linear-gradient(135deg, #0891b2, #06b6d4);
    }
    .preview-content {
        padding: 1rem;
        text-align: center;
        margin-top: -40px;
    }
    .preview-logo {
        width: 70px;
        height: 70px;
        background: white;
        border-radius: 50%;
        margin: 0 auto 0.75rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        font-weight: 700;
        color: #0891b2;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        overflow: hidden;
    }
    .preview-logo img { width: 100%; height: 100%; object-fit: cover; }
    .preview-name {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 0.25rem;
        color: #1f2937;
    }
    .preview-title {
        color: #6b7280;
        font-size: 0.875rem;
        margin-bottom: 0.25rem;
    }
    .preview-company {
        color: #9ca3af;
        font-size: 0.8rem;
        margin-bottom: 1rem;
    }
    .preview-btn-primary {
        padding: 0.5rem 1.5rem;
        background: #0891b2;
        color: white;
        border: none;
        border-radius: 0.5rem;
        font-weight: 500;
        cursor: pointer;
    }
    .preview-note {
        text-align: center;
        font-size: 0.75rem;
        color: var(--text-muted);
        margin-top: 1rem;
    }
</style>
@endpush

@push('page-scripts')
<script>
    // Color picker sync
    document.querySelectorAll('.color-picker').forEach(picker => {
        const textInput = picker.nextElementSibling;
        picker.addEventListener('input', (e) => {
            textInput.value = e.target.value;
            updatePreview();
        });
    });

    // Preset buttons
    document.querySelectorAll('.preset-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const primary = btn.dataset.primary;
            const secondary = btn.dataset.secondary;
            const accent = btn.dataset.accent;

            document.querySelector('input[name="primary_color"]').value = primary;
            document.querySelector('input[name="secondary_color"]').value = secondary;
            document.querySelector('input[name="accent_color"]').value = accent;

            document.querySelectorAll('.color-picker').forEach(picker => {
                picker.nextElementSibling.value = picker.value;
            });

            updatePreview();
        });
    });

    // Font preview
    document.querySelectorAll('.font-select').forEach(select => {
        select.addEventListener('change', (e) => {
            const previewId = select.dataset.preview;
            document.getElementById(previewId).style.fontFamily = e.target.value;
        });
    });

    // Live preview update
    function updatePreview() {
        const primaryColor = document.querySelector('input[name="primary_color"]').value;
        document.getElementById('previewHeader').style.background = `linear-gradient(135deg, ${primaryColor}, ${primaryColor}cc)`;
        document.getElementById('previewBtn').style.background = primaryColor;
    }
</script>
@endpush
@endsection
