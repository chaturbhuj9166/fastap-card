<div class="fastap-chatbot" id="fastap-chatbot">
    <button class="chatbot-toggle" id="chatbot-toggle" aria-expanded="false" aria-controls="chatbot-panel">
        <span class="chatbot-toggle-icon">
            <i class="fas fa-comment-dots"></i>
        </span>
        <span class="chatbot-toggle-text">Ask Fastap</span>
    </button>

    <div class="chatbot-panel" id="chatbot-panel" role="dialog" aria-modal="false" aria-labelledby="chatbot-title">
        <div class="chatbot-header">
            <div class="chatbot-title">
                <span class="chatbot-badge">FAQ</span>
                <h3 id="chatbot-title">Fastap Help</h3>
            </div>
            <button class="chatbot-close" id="chatbot-close" aria-label="Close chatbot">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <div class="chatbot-messages" id="chatbot-messages" aria-live="polite">
            <div class="chatbot-message bot">
                <div class="chatbot-avatar">F</div>
                <div class="chatbot-bubble">
                    Hi! I can help with Fastap FAQs. What would you like to know?
                </div>
            </div>
        </div>

        <div class="chatbot-suggestions" id="chatbot-suggestions">
            <div class="chatbot-suggestions-header">
                <span class="chatbot-suggestions-title" id="chatbot-suggestions-title">Main menu</span>
                <button type="button" class="chatbot-back" id="chatbot-back" hidden>Back to menu</button>
            </div>
            <div class="chatbot-suggestions-grid" id="chatbot-suggestions-grid"></div>
        </div>

        <form class="chatbot-input" id="chatbot-form">
            <input
                type="text"
                id="chatbot-input"
                placeholder="Ask about pricing, features, or ordering..."
                autocomplete="off"
                aria-label="Type your question"
            >
            <button type="submit" class="chatbot-send" aria-label="Send">
                <i class="fas fa-paper-plane"></i>
            </button>
        </form>
    </div>
</div>

<style>
.fastap-chatbot {
    position: fixed;
    right: 1.5rem;
    bottom: 7rem;
    z-index: var(--z-tooltip);
    font-family: var(--font-primary);
}

.chatbot-toggle {
    display: inline-flex;
    align-items: center;
    gap: 0.6rem;
    padding: 0.85rem 1.2rem;
    border: none;
    border-radius: var(--radius-full);
    background: var(--gradient-purple);
    color: white;
    box-shadow: var(--shadow-lg);
    cursor: pointer;
    transition: transform var(--transition-base), box-shadow var(--transition-base);
}

.chatbot-toggle:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-xl);
}

.chatbot-toggle-icon {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.2);
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

.chatbot-toggle-text {
    font-weight: var(--font-semibold);
    font-size: var(--text-sm);
}

.chatbot-panel {
    position: absolute;
    right: 0;
    bottom: 4.5rem;
    width: 320px;
    max-height: 70vh;
    background: var(--card-bg);
    border-radius: var(--radius-2xl);
    box-shadow: var(--shadow-xl);
    border: 1px solid var(--card-border);
    display: none;
    flex-direction: column;
    overflow: hidden;
}

.chatbot-panel.open {
    display: flex;
    animation: chatbotSlideIn 0.2s ease-out;
}

@keyframes chatbotSlideIn {
    from { transform: translateY(10px); opacity: 0; }
    to { transform: translateY(0); opacity: 1; }
}

.chatbot-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 1rem;
    background: var(--bg-secondary);
    border-bottom: 1px solid var(--border-light);
}

.chatbot-title {
    display: flex;
    flex-direction: column;
    gap: 0.2rem;
}

.chatbot-title h3 {
    margin: 0;
    font-size: var(--text-lg);
    color: var(--text-primary);
    font-family: var(--font-heading);
}

.chatbot-badge {
    display: inline-flex;
    width: fit-content;
    font-size: var(--text-xs);
    text-transform: uppercase;
    letter-spacing: 0.08em;
    padding: 0.2rem 0.5rem;
    border-radius: var(--radius-full);
    background: rgba(124, 58, 237, 0.12);
    color: var(--purple-500);
    font-weight: var(--font-semibold);
}

.chatbot-close {
    border: none;
    background: transparent;
    color: var(--text-secondary);
    font-size: 1rem;
    cursor: pointer;
}

.chatbot-messages {
    padding: 1rem;
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
    overflow-y: auto;
    flex: 1;
}

.chatbot-message {
    display: flex;
    gap: 0.6rem;
}

.chatbot-message.user {
    justify-content: flex-end;
}

.chatbot-message.user .chatbot-bubble {
    background: var(--gradient-purple);
    color: white;
    margin-left: auto;
}

.chatbot-avatar {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: var(--gradient-purple);
    color: white;
    font-weight: var(--font-semibold);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: var(--text-sm);
    flex-shrink: 0;
}

.chatbot-bubble {
    background: var(--bg-secondary);
    padding: 0.75rem 0.9rem;
    border-radius: var(--radius-xl);
    color: var(--text-primary);
    font-size: var(--text-sm);
    line-height: var(--leading-relaxed);
    max-width: 210px;
}

.chatbot-bubble a {
    color: var(--purple-500);
    text-decoration: none;
    font-weight: var(--font-semibold);
}

.chatbot-bubble a:hover {
    text-decoration: underline;
}

.chatbot-suggestions {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    padding: 0.75rem 1rem 0;
}

.chatbot-suggestions-header {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 0.5rem;
}

.chatbot-suggestions-title {
    font-size: var(--text-xs);
    text-transform: uppercase;
    letter-spacing: 0.08em;
    color: var(--text-muted);
    font-weight: var(--font-semibold);
}

.chatbot-back {
    border: 1px solid var(--border-light);
    background: transparent;
    color: var(--text-secondary);
    font-size: var(--text-xs);
    padding: 0.35rem 0.6rem;
    border-radius: var(--radius-full);
    cursor: pointer;
    transition: all var(--transition-fast);
}

.chatbot-back:hover {
    border-color: var(--purple-400);
    color: var(--text-primary);
}

.chatbot-suggestions-grid {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    width: 100%;
}

.chatbot-chip {
    border: 1px solid var(--border-light);
    background: var(--bg-secondary);
    color: var(--text-secondary);
    font-size: var(--text-xs);
    padding: 0.4rem 0.6rem;
    border-radius: var(--radius-full);
    cursor: pointer;
    transition: all var(--transition-fast);
}

.chatbot-chip:hover {
    border-color: var(--purple-400);
    color: var(--text-primary);
}

.chatbot-input {
    display: flex;
    gap: 0.5rem;
    padding: 1rem;
    border-top: 1px solid var(--border-light);
    background: var(--bg-secondary);
}

.chatbot-input input {
    flex: 1;
    border: 1px solid var(--border-light);
    border-radius: var(--radius-lg);
    padding: 0.6rem 0.8rem;
    font-size: var(--text-sm);
    background: var(--card-bg);
    color: var(--text-primary);
}

.chatbot-input input:focus {
    outline: none;
    border-color: var(--purple-400);
    box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.12);
}

.chatbot-send {
    width: 40px;
    border: none;
    border-radius: var(--radius-lg);
    background: var(--gradient-purple);
    color: white;
    cursor: pointer;
}

@media (max-width: 768px) {
    .fastap-chatbot {
        right: 1rem;
        bottom: 6.75rem;
    }

    .chatbot-panel {
        width: 90vw;
        right: 0;
    }
}
</style>

<script>
(function () {
    const toggleBtn = document.getElementById('chatbot-toggle');
    const panel = document.getElementById('chatbot-panel');
    const closeBtn = document.getElementById('chatbot-close');
    const form = document.getElementById('chatbot-form');
    const input = document.getElementById('chatbot-input');
    const messages = document.getElementById('chatbot-messages');
    const suggestionsTitle = document.getElementById('chatbot-suggestions-title');
    const suggestionsGrid = document.getElementById('chatbot-suggestions-grid');
    const backBtn = document.getElementById('chatbot-back');

    const categories = [
        {
            id: 'getting-started',
            title: 'Getting Started',
            items: [
                {
                    question: 'What is Fastap?',
                    answer: 'Fastap is an NFC-enabled digital business card platform. Tap or scan to share your profile, contact details, and services instantly.',
                    keywords: ['fastap', 'what is', 'digital business card']
                },
                {
                    question: 'Do I need an app to use Fastap?',
                    answer: 'No app required. Profiles open directly in the browser on Android and iOS devices.',
                    keywords: ['app', 'install', 'download']
                },
                {
                    question: 'How do I set up my profile?',
                    answer: 'Log in to your dashboard, add your info, and choose a theme. Updates are live immediately.',
                    keywords: ['setup', 'profile setup', 'dashboard']
                },
            ],
        },
        {
            id: 'cards-nfc',
            title: 'Cards & NFC',
            items: [
                {
                    question: 'How does the NFC card work?',
                    answer: 'Just tap the card on any NFC-enabled smartphone, or scan the QR code. Your Fastap profile opens instantly in the browser.',
                    keywords: ['nfc', 'tap', 'card work', 'qr']
                },
                {
                    question: 'What card types are available?',
                    answer: 'Fastap offers a Google Review Card, Business Card, and Premium Gold Card options based on your needs.',
                    keywords: ['card types', 'google review', 'business card', 'gold card']
                },
                {
                    question: 'Can I share without the card?',
                    answer: 'Yes. Your profile has a direct link and QR code you can share digitally anytime.',
                    keywords: ['share link', 'qr code', 'without card']
                },
            ],
        },
        {
            id: 'profile-themes',
            title: 'Profile & Themes',
            items: [
                {
                    question: 'Can I update my profile anytime?',
                    answer: 'Yes. Update your contact info, links, portfolio, or services anytime from your dashboard. Changes apply instantly.',
                    keywords: ['update', 'edit', 'change', 'profile']
                },
                {
                    question: 'Can I change my theme?',
                    answer: 'Yes. You can switch themes from your dashboard to match your profession or brand.',
                    keywords: ['theme', 'switch theme', 'design']
                },
                {
                    question: 'What features do I get?',
                    answer: 'Fastap includes instant sharing, customizable themes, analytics, QR codes, and profile sections like services, portfolio, and social links.',
                    keywords: ['features', 'what do i get', 'include']
                },
            ],
        },
        {
            id: 'pricing-orders',
            title: 'Pricing & Orders',
            items: [
                {
                    question: 'How does pricing work?',
                    answer: 'We offer multiple card options including Business and Premium cards. Plans include lifetime updates and support. <a href="/#pricing-plans">See pricing</a>.',
                    keywords: ['pricing', 'plans', 'cost', 'price']
                },
                {
                    question: 'How do I order a card?',
                    answer: 'You can order from our products page and choose the plan that fits you best. <a href="/Product">View products</a>.',
                    keywords: ['order', 'buy', 'purchase']
                },
                {
                    question: 'Can I reorder or add extra cards?',
                    answer: 'Yes. You can place another order anytime from the products page.',
                    keywords: ['reorder', 'extra cards', 'second card']
                },
            ],
        },
        {
            id: 'support',
            title: 'Support & Help',
            items: [
                {
                    question: 'Do you provide analytics?',
                    answer: 'Yes. Your dashboard shows profile views and engagement so you can track how people interact with your card.',
                    keywords: ['analytics', 'tracking', 'views', 'insights']
                },
                {
                    question: 'What support is available?',
                    answer: 'Fastap provides customer support and onboarding help. Reach out via the contact page anytime.',
                    keywords: ['support', 'help', 'contact']
                },
                {
                    question: 'How can I contact Fastap?',
                    answer: 'Use the contact page for support or sales inquiries. <a href="/Contact-Us">Contact us</a>.',
                    keywords: ['contact', 'email', 'support']
                },
            ],
        },
    ];

    const faqs = categories.flatMap((category) => category.items);
    let currentCategory = null;

    const openChat = () => {
        panel.classList.add('open');
        toggleBtn.setAttribute('aria-expanded', 'true');
        input.focus();
    };

    const closeChat = () => {
        panel.classList.remove('open');
        toggleBtn.setAttribute('aria-expanded', 'false');
    };

    const addMessage = (text, type = 'bot') => {
        const message = document.createElement('div');
        message.className = `chatbot-message ${type}`;

        if (type === 'bot') {
            const avatar = document.createElement('div');
            avatar.className = 'chatbot-avatar';
            avatar.textContent = 'F';
            message.appendChild(avatar);
        }

        const bubble = document.createElement('div');
        bubble.className = 'chatbot-bubble';
        bubble.innerHTML = text;
        message.appendChild(bubble);

        messages.appendChild(message);
        messages.scrollTop = messages.scrollHeight;
    };

    const findAnswer = (question) => {
        const text = question.toLowerCase();
        const match = faqs.find(item => item.question.toLowerCase() === text
            || item.keywords.some(key => text.includes(key)));
        if (match) {
            return match.answer;
        }
        return "I can help with Fastap FAQs. Pick a category from the menu or visit <a href=\"/Contact-Us\">Contact Us</a>.";
    };

    const handleUserQuestion = (question) => {
        if (!question.trim()) {
            return;
        }
        addMessage(question, 'user');
        const response = findAnswer(question);
        setTimeout(() => addMessage(response, 'bot'), 300);
    };

    const renderMenu = () => {
        currentCategory = null;
        suggestionsTitle.textContent = 'Main menu';
        backBtn.hidden = true;
        suggestionsGrid.innerHTML = '';
        categories.forEach((category) => {
            const button = document.createElement('button');
            button.type = 'button';
            button.className = 'chatbot-chip';
            button.dataset.category = category.id;
            button.textContent = category.title;
            suggestionsGrid.appendChild(button);
        });
    };

    const renderCategory = (categoryId) => {
        const category = categories.find((item) => item.id === categoryId);
        if (!category) {
            renderMenu();
            return;
        }
        currentCategory = category.id;
        suggestionsTitle.textContent = category.title;
        backBtn.hidden = false;
        suggestionsGrid.innerHTML = '';
        category.items.forEach((item) => {
            const button = document.createElement('button');
            button.type = 'button';
            button.className = 'chatbot-chip';
            button.dataset.question = item.question;
            button.textContent = item.question;
            suggestionsGrid.appendChild(button);
        });
    };

    toggleBtn.addEventListener('click', () => {
        panel.classList.contains('open') ? closeChat() : openChat();
    });

    closeBtn.addEventListener('click', closeChat);

    form.addEventListener('submit', (event) => {
        event.preventDefault();
        handleUserQuestion(input.value);
        input.value = '';
    });

    backBtn.addEventListener('click', renderMenu);

    suggestionsGrid.addEventListener('click', (event) => {
        const target = event.target.closest('.chatbot-chip');
        if (!target) {
            return;
        }
        if (target.dataset.category) {
            renderCategory(target.dataset.category);
            return;
        }
        handleUserQuestion(target.dataset.question || target.textContent);
    });

    renderMenu();
})();
</script>
