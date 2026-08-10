{{-- ========================================
     FASTAP - WhatsApp Floating Button
     Modern WhatsApp chat button
     ======================================== --}}

<div class="whatsapp-float">
    <a href="https://wa.me/919999999999?text=Hi%20Fastap%2C%20I%20have%20a%20question"
       class="whatsapp-button"
       target="_blank"
       rel="noopener noreferrer"
       aria-label="Chat on WhatsApp">
        <i class="fab fa-whatsapp"></i>
        <span class="whatsapp-tooltip">Chat with us</span>
    </a>
</div>

<style>
/* ============= WHATSAPP FLOATING BUTTON ============= */
.whatsapp-float {
    position: fixed;
    bottom: 30px;
    right: 30px;
    z-index: var(--z-fixed);
}

.whatsapp-button {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #25D366 0%, #128C7E 100%);
    border-radius: var(--radius-full);
    color: white;
    font-size: 28px;
    box-shadow: 0 4px 20px rgba(37, 211, 102, 0.4);
    transition: all var(--transition-base);
    animation: pulse-whatsapp 2s ease-in-out infinite;
}

.whatsapp-button:hover {
    transform: scale(1.1);
    box-shadow: 0 6px 30px rgba(37, 211, 102, 0.6);
    animation: none;
}

.whatsapp-button i {
    color: white;
}

/* Tooltip */
.whatsapp-tooltip {
    position: absolute;
    right: 70px;
    background: var(--card-bg);
    color: var(--text-primary);
    padding: 0.75rem 1.25rem;
    border-radius: var(--radius-lg);
    font-size: var(--text-sm);
    font-weight: var(--font-medium);
    white-space: nowrap;
    box-shadow: var(--shadow-lg);
    border: 1px solid var(--border-light);
    opacity: 0;
    pointer-events: none;
    transform: translateX(10px);
    transition: all var(--transition-base);
}

.whatsapp-tooltip::after {
    content: '';
    position: absolute;
    right: -6px;
    top: 50%;
    transform: translateY(-50%);
    width: 0;
    height: 0;
    border-top: 6px solid transparent;
    border-bottom: 6px solid transparent;
    border-left: 6px solid var(--card-bg);
}

.whatsapp-button:hover .whatsapp-tooltip {
    opacity: 1;
    transform: translateX(0);
}

/* Pulse Animation */
@keyframes pulse-whatsapp {
    0%, 100% {
        box-shadow: 0 4px 20px rgba(37, 211, 102, 0.4),
                    0 0 0 0 rgba(37, 211, 102, 0.4);
    }
    50% {
        box-shadow: 0 4px 20px rgba(37, 211, 102, 0.4),
                    0 0 0 10px rgba(37, 211, 102, 0);
    }
}

/* Responsive */
@media (max-width: 768px) {
    .whatsapp-float {
        bottom: 20px;
        right: 20px;
    }

    .whatsapp-button {
        width: 56px;
        height: 56px;
        font-size: 26px;
    }

    .whatsapp-tooltip {
        display: none; /* Hide tooltip on mobile */
    }
}
</style>
