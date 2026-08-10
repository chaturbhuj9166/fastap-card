<!-- WhatsApp Floating Button -->
<a href="https://wa.me/919876543210" class="whatsapp-btn" target="_blank" rel="noopener noreferrer" aria-label="Chat on WhatsApp">
    <i class="fab fa-whatsapp"></i>
    <span class="whatsapp-tooltip">Chat with us</span>
</a>

<style>
.whatsapp-btn {
    position: fixed;
    bottom: 24px;
    right: 24px;
    width: 56px;
    height: 56px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #25D366;
    color: white;
    border-radius: var(--radius-full);
    font-size: 28px;
    text-decoration: none;
    box-shadow: 0 4px 20px rgba(37, 211, 102, 0.4);
    z-index: 999;
    transition: all var(--transition-base);
}

.whatsapp-btn:hover {
    transform: scale(1.1);
    box-shadow: 0 6px 25px rgba(37, 211, 102, 0.5);
}

.whatsapp-tooltip {
    position: absolute;
    right: 70px;
    background: var(--bg-primary);
    color: var(--text-primary);
    padding: 8px 16px;
    border-radius: var(--radius-md);
    font-size: var(--text-sm);
    font-weight: var(--font-medium);
    white-space: nowrap;
    box-shadow: var(--shadow-md);
    opacity: 0;
    visibility: hidden;
    transition: all var(--transition-fast);
}

.whatsapp-btn:hover .whatsapp-tooltip {
    opacity: 1;
    visibility: visible;
}

@media (max-width: 768px) {
    .whatsapp-btn {
        width: 50px;
        height: 50px;
        font-size: 24px;
        bottom: 16px;
        right: 16px;
    }

    .whatsapp-tooltip {
        display: none;
    }
}
</style>
