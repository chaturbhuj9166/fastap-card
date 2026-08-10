@extends('layouts.redesign.agent')

@section('page-title', 'Support')
@section('breadcrumb', 'Support')

@push('page-styles')
<style>
    .support-container {
        max-width: 800px;
    }

    .support-card {
        background: var(--card-bg);
        border: 1px solid var(--card-border);
        border-radius: var(--radius-xl);
        padding: var(--space-xl);
        margin-bottom: var(--space-lg);
    }

    .support-header {
        text-align: center;
        margin-bottom: var(--space-xl);
    }

    .support-icon {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--purple-500), var(--blue-500));
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto var(--space-lg);
    }

    .support-icon i {
        font-size: 2.5rem;
        color: white;
    }

    .support-title {
        font-size: var(--text-2xl);
        font-weight: var(--font-bold);
        color: var(--text-primary);
        margin-bottom: var(--space-sm);
    }

    .support-subtitle {
        color: var(--text-muted);
    }

    .contact-options {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: var(--space-lg);
        margin-top: var(--space-xl);
    }

    .contact-option {
        text-align: center;
        padding: var(--space-xl);
        background: var(--bg-secondary);
        border-radius: var(--radius-lg);
        transition: transform var(--transition-fast), box-shadow var(--transition-fast);
    }

    .contact-option:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-lg);
    }

    .contact-option i {
        font-size: 2rem;
        color: var(--purple-500);
        margin-bottom: var(--space-md);
    }

    .contact-option h4 {
        font-weight: var(--font-semibold);
        color: var(--text-primary);
        margin-bottom: var(--space-xs);
    }

    .contact-option p {
        font-size: var(--text-sm);
        color: var(--text-muted);
    }

    .contact-option a {
        color: var(--blue-500);
        text-decoration: none;
    }

    .contact-option a:hover {
        text-decoration: underline;
    }

    .faq-section {
        margin-top: var(--space-xl);
    }

    .faq-section h3 {
        font-size: var(--text-lg);
        font-weight: var(--font-semibold);
        margin-bottom: var(--space-lg);
    }

    .faq-item {
        background: var(--bg-secondary);
        border-radius: var(--radius-md);
        padding: var(--space-md);
        margin-bottom: var(--space-sm);
        cursor: pointer;
    }

    .faq-question {
        font-weight: var(--font-medium);
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .faq-answer {
        margin-top: var(--space-sm);
        padding-top: var(--space-sm);
        border-top: 1px solid var(--card-border);
        color: var(--text-secondary);
        font-size: var(--text-sm);
        display: none;
    }

    .faq-item.active .faq-answer {
        display: block;
    }
</style>
@endpush

@section('agent-content')
<div class="support-container">
    <div class="support-card">
        <div class="support-header">
            <div class="support-icon">
                <i class="fas fa-headset"></i>
            </div>
            <h1 class="support-title">Need Help?</h1>
            <p class="support-subtitle">We're here to assist you. Choose how you'd like to reach us.</p>
        </div>

        <div class="contact-options">
            <div class="contact-option">
                <i class="fas fa-envelope"></i>
                <h4>Email Support</h4>
                <p>Send us an email and we'll respond within 24 hours</p>
                <a href="mailto:support@fastap.in">support@fastap.in</a>
            </div>

            <div class="contact-option">
                <i class="fas fa-phone"></i>
                <h4>Phone Support</h4>
                <p>Call us during business hours</p>
                <a href="tel:+919999999999">+91 99999 99999</a>
            </div>

            <div class="contact-option">
                <i class="fab fa-whatsapp"></i>
                <h4>WhatsApp</h4>
                <p>Chat with us on WhatsApp</p>
                <a href="https://wa.me/919999999999" target="_blank">Start Chat</a>
            </div>
        </div>
    </div>

    <div class="support-card faq-section">
        <h3><i class="fas fa-question-circle" style="color: var(--purple-500); margin-right: var(--space-sm);"></i> Common Questions</h3>

        <div class="faq-item" onclick="this.classList.toggle('active')">
            <div class="faq-question">
                How do I reset my password?
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer">
                You can reset your password by clicking on "Forgot Password" on the login page and following the instructions sent to your email.
            </div>
        </div>

        <div class="faq-item" onclick="this.classList.toggle('active')">
            <div class="faq-question">
                How do I update my profile information?
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer">
                Go to "My Profile" in the sidebar menu. Note that some fields may require admin approval to change.
            </div>
        </div>

        <div class="faq-item" onclick="this.classList.toggle('active')">
            <div class="faq-question">
                How do I track my commission earnings?
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer">
                Your commission earnings are displayed on your dashboard. You can also view detailed order-wise commission in the Orders section.
            </div>
        </div>

        <div class="faq-item" onclick="this.classList.toggle('active')">
            <div class="faq-question">
                How do I add new users?
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer">
                Navigate to "Add New User" in the sidebar. You can add users individually or upload a CSV file for bulk upload.
            </div>
        </div>
    </div>
</div>

@endsection
