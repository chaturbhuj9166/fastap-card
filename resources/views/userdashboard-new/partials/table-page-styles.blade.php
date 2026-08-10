<style>
.table-section {
    background: var(--bg-primary);
    border: 1px solid var(--border-light);
    border-radius: var(--radius-xl);
    overflow: hidden;
}

.table-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: var(--space-lg);
    border-bottom: 1px solid var(--border-light);
    background: var(--bg-secondary);
    gap: var(--space-md);
    flex-wrap: wrap;
}

.table-header h3 {
    font-size: var(--text-base);
    font-weight: var(--font-semibold);
    display: flex;
    align-items: center;
    gap: var(--space-sm);
    margin: 0;
}

.table-header h3 i {
    color: var(--purple-500);
}

.data-table {
    width: 100%;
    border-collapse: collapse;
}

.data-table th,
.data-table td {
    padding: var(--space-md);
    text-align: left;
    border-bottom: 1px solid var(--border-light);
    font-size: var(--text-sm);
    color: var(--text-secondary);
    vertical-align: middle;
}

.data-table th {
    font-size: var(--text-xs);
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: var(--text-muted);
    background: var(--bg-tertiary);
}

.data-table tbody tr:hover {
    background: var(--bg-secondary);
}

.status-badge {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 4px 10px;
    font-size: var(--text-xs);
    border-radius: var(--radius-full);
    font-weight: var(--font-medium);
    text-transform: capitalize;
}

.status-badge.success { background: rgba(16, 185, 129, 0.12); color: var(--green-600); }
.status-badge.warning { background: rgba(249, 115, 22, 0.12); color: var(--orange-600); }
.status-badge.danger { background: rgba(239, 68, 68, 0.12); color: var(--red-600); }
.status-badge.secondary { background: var(--bg-tertiary); color: var(--text-secondary); }
.status-badge.info { background: rgba(59, 130, 246, 0.12); color: var(--blue-600); }

.table-actions {
    display: inline-flex;
    gap: var(--space-xs);
}

.action-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    border-radius: var(--radius-md);
    border: 1px solid var(--border-light);
    background: var(--bg-secondary);
    color: var(--text-secondary);
    text-decoration: none;
    transition: all var(--transition-fast);
}

.action-btn:hover {
    background: var(--purple-500);
    border-color: var(--purple-500);
    color: white;
}

.action-btn.success:hover {
    background: var(--green-500);
    border-color: var(--green-500);
}

.action-btn.danger:hover {
    background: var(--red-500);
    border-color: var(--red-500);
}

.action-btn.warning:hover {
    background: var(--orange-500);
    border-color: var(--orange-500);
}

.table-footer {
    padding: var(--space-md) var(--space-lg);
    border-top: 1px solid var(--border-light);
    background: var(--bg-secondary);
}
</style>
