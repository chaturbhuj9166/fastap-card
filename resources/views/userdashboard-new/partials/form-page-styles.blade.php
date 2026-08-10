<style>
/* Form Page Common Styles */
.form-page {
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

/* Form Card */
.form-card {
    background: var(--bg-primary);
    border: 1px solid var(--border-light);
    border-radius: var(--radius-xl);
    overflow: hidden;
}

.form-card-header {
    padding: var(--space-lg);
    border-bottom: 1px solid var(--border-light);
    background: var(--bg-secondary);
}

.form-card-header h3 {
    font-size: var(--text-base);
    font-weight: var(--font-semibold);
    display: flex;
    align-items: center;
    gap: var(--space-sm);
    margin: 0;
}

.form-card-header h3 i {
    color: var(--purple-500);
}

.form-card-body {
    padding: var(--space-xl);
}

.form-card-footer {
    display: flex;
    gap: var(--space-md);
    padding: var(--space-lg);
    border-top: 1px solid var(--border-light);
    background: var(--bg-secondary);
}

/* Form Elements */
.form-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: var(--space-md);
    margin-bottom: var(--space-md);
}

.form-row:last-child {
    margin-bottom: 0;
}

.form-group {
    margin-bottom: var(--space-lg);
}

.form-group:last-child {
    margin-bottom: 0;
}

.form-group label {
    display: block;
    font-size: var(--text-sm);
    font-weight: var(--font-medium);
    color: var(--text-primary);
    margin-bottom: var(--space-xs);
}

.form-group label .required {
    color: var(--red-500);
}

.form-control {
    width: 100%;
    padding: var(--space-sm) var(--space-md);
    border: 1px solid var(--border-light);
    border-radius: var(--radius-lg);
    background: var(--bg-secondary);
    color: var(--text-primary);
    font-size: var(--text-base);
    transition: all var(--transition-fast);
}

.form-control:focus {
    outline: none;
    border-color: var(--purple-500);
    box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1);
}

.form-control.is-invalid {
    border-color: var(--red-500);
}

textarea.form-control {
    resize: vertical;
    min-height: 120px;
}

.form-error {
    display: block;
    font-size: var(--text-xs);
    color: var(--red-500);
    margin-top: var(--space-xs);
}

.form-hint {
    display: block;
    font-size: var(--text-xs);
    color: var(--text-muted);
    margin-top: var(--space-xs);
}

/* File Upload */
.file-upload-zone {
    border: 2px dashed var(--border-light);
    border-radius: var(--radius-xl);
    padding: var(--space-xl);
    text-align: center;
    cursor: pointer;
    transition: all var(--transition-fast);
    background: var(--bg-secondary);
}

.file-upload-zone:hover,
.file-upload-zone.dragover {
    border-color: var(--purple-500);
    background: rgba(139, 92, 246, 0.05);
}

.upload-icon {
    width: 50px;
    height: 50px;
    margin: 0 auto var(--space-md);
    background: var(--bg-tertiary);
    border-radius: var(--radius-full);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: var(--text-xl);
    color: var(--purple-500);
}

.upload-content h4 {
    font-size: var(--text-sm);
    font-weight: var(--font-semibold);
    margin-bottom: var(--space-xs);
}

.upload-content p {
    font-size: var(--text-sm);
    color: var(--text-secondary);
    margin-bottom: var(--space-xs);
}

.browse-link {
    color: var(--purple-500);
    font-weight: var(--font-medium);
    cursor: pointer;
}

.upload-hint {
    font-size: var(--text-xs);
    color: var(--text-muted);
}

/* Image Preview */
.image-preview-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
    gap: var(--space-md);
    margin-top: var(--space-md);
}

.preview-item {
    position: relative;
    aspect-ratio: 1;
    border-radius: var(--radius-lg);
    overflow: hidden;
    border: 1px solid var(--border-light);
}

.preview-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.preview-remove {
    position: absolute;
    top: 4px;
    right: 4px;
    width: 24px;
    height: 24px;
    background: rgba(239, 68, 68, 0.9);
    border: none;
    border-radius: var(--radius-full);
    color: white;
    font-size: var(--text-xs);
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Current Images */
.current-images-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(80px, 1fr));
    gap: var(--space-sm);
    margin-bottom: var(--space-md);
}

.current-image-item {
    position: relative;
    aspect-ratio: 1;
    border-radius: var(--radius-md);
    overflow: hidden;
    border: 2px solid var(--border-light);
}

.current-image-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* Responsive */
@media (max-width: 576px) {
    .form-card-footer {
        flex-direction: column;
    }

    .form-card-footer .btn {
        width: 100%;
        justify-content: center;
    }
}
</style>
