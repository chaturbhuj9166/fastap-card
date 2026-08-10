@if(session('success'))
    <div class="alert alert-success" role="alert">
        <div class="alert-content">
            <i class="fas fa-check-circle alert-icon"></i>
            <span class="alert-message">{{ session('success') }}</span>
        </div>
        <button type="button" class="alert-dismiss" onclick="this.parentElement.remove()">
            <i class="fas fa-times"></i>
        </button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-error" role="alert">
        <div class="alert-content">
            <i class="fas fa-times-circle alert-icon"></i>
            <span class="alert-message">{{ session('error') }}</span>
        </div>
        <button type="button" class="alert-dismiss" onclick="this.parentElement.remove()">
            <i class="fas fa-times"></i>
        </button>
    </div>
@endif

@if(session('warning'))
    <div class="alert alert-warning" role="alert">
        <div class="alert-content">
            <i class="fas fa-exclamation-triangle alert-icon"></i>
            <span class="alert-message">{{ session('warning') }}</span>
        </div>
        <button type="button" class="alert-dismiss" onclick="this.parentElement.remove()">
            <i class="fas fa-times"></i>
        </button>
    </div>
@endif

@if(session('info'))
    <div class="alert alert-info" role="alert">
        <div class="alert-content">
            <i class="fas fa-info-circle alert-icon"></i>
            <span class="alert-message">{{ session('info') }}</span>
        </div>
        <button type="button" class="alert-dismiss" onclick="this.parentElement.remove()">
            <i class="fas fa-times"></i>
        </button>
    </div>
@endif

@if($errors->any())
    <div class="alert alert-error" role="alert">
        <div class="alert-content">
            <i class="fas fa-times-circle alert-icon"></i>
            <div class="alert-message">
                <ul style="margin: 0; padding-left: 1rem;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        <button type="button" class="alert-dismiss" onclick="this.parentElement.remove()">
            <i class="fas fa-times"></i>
        </button>
    </div>
@endif

<style>
.alert {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    padding: var(--space-md) var(--space-lg);
    border-radius: var(--radius-lg);
    margin-bottom: var(--space-lg);
    animation: slideDown 0.3s ease;
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.alert-content {
    display: flex;
    align-items: flex-start;
    gap: var(--space-sm);
}

.alert-icon {
    font-size: var(--text-lg);
    margin-top: 2px;
}

.alert-message {
    flex: 1;
}

.alert-dismiss {
    background: transparent;
    border: none;
    cursor: pointer;
    padding: var(--space-xs);
    color: inherit;
    opacity: 0.7;
    transition: opacity var(--transition-fast);
}

.alert-dismiss:hover {
    opacity: 1;
}

.alert-success {
    background: linear-gradient(135deg, rgba(16, 185, 129, 0.1) 0%, rgba(5, 150, 105, 0.1) 100%);
    border: 1px solid rgba(16, 185, 129, 0.3);
    color: var(--green-600);
}

.alert-error {
    background: linear-gradient(135deg, rgba(239, 68, 68, 0.1) 0%, rgba(220, 38, 38, 0.1) 100%);
    border: 1px solid rgba(239, 68, 68, 0.3);
    color: #dc2626;
}

.alert-warning {
    background: linear-gradient(135deg, rgba(249, 115, 22, 0.1) 0%, rgba(234, 88, 12, 0.1) 100%);
    border: 1px solid rgba(249, 115, 22, 0.3);
    color: var(--orange-600);
}

.alert-info {
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, rgba(37, 99, 235, 0.1) 100%);
    border: 1px solid rgba(59, 130, 246, 0.3);
    color: var(--blue-600);
}
</style>
