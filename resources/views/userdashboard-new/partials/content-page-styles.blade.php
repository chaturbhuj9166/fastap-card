<style>
/* Content Page Common Styles */
.qualifications-page,
.professions-page,
.thoughts-page,
.products-page {
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

/* Stats Row */
.stats-row {
    margin-bottom: var(--space-xl);
}

.stat-mini-card {
    background: var(--bg-primary);
    border: 1px solid var(--border-light);
    border-radius: var(--radius-xl);
    padding: var(--space-lg);
    display: inline-flex;
    align-items: center;
    gap: var(--space-md);
}

.stat-mini-icon {
    width: 45px;
    height: 45px;
    border-radius: var(--radius-lg);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: var(--text-lg);
}

.stat-mini-icon.blue { background: linear-gradient(135deg, rgba(59, 130, 246, 0.15) 0%, rgba(96, 165, 250, 0.15) 100%); color: var(--blue-500); }
.stat-mini-icon.purple { background: linear-gradient(135deg, rgba(139, 92, 246, 0.15) 0%, rgba(168, 85, 247, 0.15) 100%); color: var(--purple-500); }
.stat-mini-icon.green { background: linear-gradient(135deg, rgba(16, 185, 129, 0.15) 0%, rgba(52, 211, 153, 0.15) 100%); color: var(--green-500); }
.stat-mini-icon.orange { background: linear-gradient(135deg, rgba(249, 115, 22, 0.15) 0%, rgba(251, 146, 60, 0.15) 100%); color: var(--orange-500); }

.stat-mini-info {
    display: flex;
    flex-direction: column;
}

.stat-mini-value {
    font-size: var(--text-xl);
    font-weight: var(--font-bold);
    color: var(--text-primary);
}

.stat-mini-label {
    font-size: var(--text-xs);
    color: var(--text-muted);
}

/* Items Grid */
.items-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: var(--space-lg);
}

/* Item Card */
.item-card {
    background: var(--bg-primary);
    border: 1px solid var(--border-light);
    border-radius: var(--radius-xl);
    padding: var(--space-lg);
    transition: all var(--transition-base);
    display: flex;
    flex-direction: column;
}

.item-card:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-lg);
}

.item-card-icon {
    width: 50px;
    height: 50px;
    background: var(--gradient-purple);
    border-radius: var(--radius-lg);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: var(--text-xl);
    color: white;
    margin-bottom: var(--space-md);
}

.item-card-body {
    flex: 1;
}

.item-title {
    font-size: var(--text-base);
    font-weight: var(--font-semibold);
    margin-bottom: var(--space-xs);
    color: var(--text-primary);
}

.item-description {
    font-size: var(--text-sm);
    color: var(--text-secondary);
    margin-bottom: var(--space-sm);
    line-height: 1.5;
}

.item-meta {
    font-size: var(--text-sm);
    color: var(--text-secondary);
    margin-bottom: var(--space-xs);
}

.item-date {
    font-size: var(--text-xs);
    color: var(--text-muted);
    margin: 0;
}

.item-card-actions {
    display: flex;
    gap: var(--space-xs);
    margin-top: var(--space-md);
    padding-top: var(--space-md);
    border-top: 1px solid var(--border-light);
}

.action-btn {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: var(--space-sm);
    background: var(--bg-secondary);
    border: 1px solid var(--border-light);
    border-radius: var(--radius-md);
    color: var(--text-secondary);
    text-decoration: none;
    transition: all var(--transition-fast);
}

.action-btn:hover {
    background: var(--purple-500);
    border-color: var(--purple-500);
    color: white;
}

.action-btn.danger:hover {
    background: var(--red-500);
    border-color: var(--red-500);
}

/* Product Card Specific */
.product-card-image {
    position: relative;
    aspect-ratio: 4/3;
    border-radius: var(--radius-lg);
    overflow: hidden;
    margin-bottom: var(--space-md);
    background: var(--bg-secondary);
}

.product-card-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.product-placeholder {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: var(--text-3xl);
    color: var(--text-muted);
}

.product-price {
    font-size: var(--text-lg);
    font-weight: var(--font-bold);
    color: var(--green-600);
}

/* Empty State */
.empty-state {
    background: var(--bg-primary);
    border: 1px solid var(--border-light);
    border-radius: var(--radius-xl);
    text-align: center;
    padding: var(--space-3xl);
}

.empty-state-icon {
    width: 80px;
    height: 80px;
    margin: 0 auto var(--space-lg);
    background: var(--bg-secondary);
    border-radius: var(--radius-full);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: var(--text-3xl);
    color: var(--text-muted);
}

.empty-state h3 {
    font-size: var(--text-xl);
    margin-bottom: var(--space-sm);
}

.empty-state p {
    color: var(--text-secondary);
    margin-bottom: var(--space-lg);
}

/* Responsive */
@media (max-width: 576px) {
    .items-grid {
        grid-template-columns: 1fr;
    }
}
</style>
