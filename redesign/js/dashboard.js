/* ========================================
   FASTAP - Dashboard JavaScript
   Sidebar, Modals, Dropdowns, Tabs, Toasts
   ======================================== */

(function() {
  'use strict';

  // ============= SIDEBAR TOGGLE =============
  function initSidebar() {
    const sidebar = document.querySelector('.sidebar, .dashboard-sidebar');
    const sidebarToggle = document.querySelector('.sidebar-toggle');
    const mobileMenuToggle = document.querySelector('.mobile-menu-toggle, #mobileMenuToggle');
    const sidebarClose = document.querySelector('.sidebar-close, #sidebarClose');
    const dashboardMain = document.querySelector('.dashboard-main');

    if (sidebarToggle && sidebar) {
      sidebarToggle.addEventListener('click', () => {
        sidebar.classList.toggle('collapsed');
        if (dashboardMain) {
          dashboardMain.classList.toggle('sidebar-collapsed');
        }
        // Save preference
        localStorage.setItem('sidebar-collapsed', sidebar.classList.contains('collapsed'));
      });

      // Restore preference
      if (localStorage.getItem('sidebar-collapsed') === 'true') {
        sidebar.classList.add('collapsed');
        if (dashboardMain) {
          dashboardMain.classList.add('sidebar-collapsed');
        }
      }
    }

    // Mobile menu toggle
    if (mobileMenuToggle && sidebar) {
      mobileMenuToggle.addEventListener('click', () => {
        sidebar.classList.toggle('active');
        sidebar.classList.toggle('mobile-open');
      });

      // Close on outside click
      document.addEventListener('click', (e) => {
        if ((sidebar.classList.contains('mobile-open') || sidebar.classList.contains('active')) &&
            !sidebar.contains(e.target) &&
            !mobileMenuToggle.contains(e.target)) {
          sidebar.classList.remove('mobile-open');
          sidebar.classList.remove('active');
        }
      });
    }

    // Sidebar close button (mobile)
    if (sidebarClose && sidebar) {
      sidebarClose.addEventListener('click', () => {
        sidebar.classList.remove('active');
        sidebar.classList.remove('mobile-open');
      });
    }

    // Submenu toggle
    const submenuParents = document.querySelectorAll('.sidebar-nav-item.has-submenu');
    submenuParents.forEach(item => {
      const link = item.querySelector('.sidebar-nav-link');
      if (link) {
        link.addEventListener('click', (e) => {
          e.preventDefault();
          // Toggle current submenu
          item.classList.toggle('open');
        });
      }
    });
  }

  // ============= DROPDOWNS =============
  function initDropdowns() {
    const dropdowns = document.querySelectorAll('.dropdown');

    dropdowns.forEach(dropdown => {
      const trigger = dropdown.querySelector('.dropdown-trigger');

      if (trigger) {
        trigger.addEventListener('click', (e) => {
          e.stopPropagation();

          // Close other dropdowns
          dropdowns.forEach(d => {
            if (d !== dropdown) d.classList.remove('active');
          });

          dropdown.classList.toggle('active');
        });
      }
    });

    // Close on outside click
    document.addEventListener('click', () => {
      dropdowns.forEach(dropdown => {
        dropdown.classList.remove('active');
      });
    });

    // Prevent closing when clicking inside menu
    document.querySelectorAll('.dropdown-menu').forEach(menu => {
      menu.addEventListener('click', (e) => {
        e.stopPropagation();
      });
    });
  }

  // ============= MODALS =============
  function initModals() {
    const modalTriggers = document.querySelectorAll('[data-modal]');
    const modalCloses = document.querySelectorAll('.modal-close, [data-modal-close]');
    const modalBackdrops = document.querySelectorAll('.modal-backdrop');

    // Open modal
    modalTriggers.forEach(trigger => {
      trigger.addEventListener('click', () => {
        const modalId = trigger.getAttribute('data-modal');
        const modal = document.getElementById(modalId);
        const backdrop = document.querySelector('.modal-backdrop');

        if (modal && backdrop) {
          modal.classList.add('active');
          backdrop.classList.add('active');
          document.body.style.overflow = 'hidden';
        }
      });
    });

    // Close modal
    function closeModal() {
      document.querySelectorAll('.modal.active').forEach(modal => {
        modal.classList.remove('active');
      });
      document.querySelectorAll('.modal-backdrop.active').forEach(backdrop => {
        backdrop.classList.remove('active');
      });
      document.body.style.overflow = '';
    }

    modalCloses.forEach(close => {
      close.addEventListener('click', closeModal);
    });

    modalBackdrops.forEach(backdrop => {
      backdrop.addEventListener('click', closeModal);
    });

    // Close on Escape key
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') {
        closeModal();
      }
    });
  }

  // ============= TABS =============
  function initTabs() {
    const tabContainers = document.querySelectorAll('.tabs');

    tabContainers.forEach(container => {
      const tabs = container.querySelectorAll('.tab-btn');

      tabs.forEach(tab => {
        tab.addEventListener('click', () => {
          const targetId = tab.getAttribute('data-tab');
          const tabContents = document.querySelectorAll(`.tab-content[data-tab-content]`);

          // Update active tab
          tabs.forEach(t => t.classList.remove('active'));
          tab.classList.add('active');

          // Update content
          tabContents.forEach(content => {
            if (content.getAttribute('data-tab-content') === targetId) {
              content.classList.add('active');
            } else {
              content.classList.remove('active');
            }
          });
        });
      });
    });
  }

  // ============= TOAST NOTIFICATIONS =============
  window.Toast = {
    container: null,

    init: function() {
      if (!this.container) {
        this.container = document.createElement('div');
        this.container.className = 'toast-container';
        document.body.appendChild(this.container);
      }
    },

    show: function(options) {
      this.init();

      const toast = document.createElement('div');
      toast.className = `toast toast-${options.type || 'info'}`;

      const icons = {
        success: '<i class="fas fa-check"></i>',
        error: '<i class="fas fa-times"></i>',
        warning: '<i class="fas fa-exclamation"></i>',
        info: '<i class="fas fa-info"></i>'
      };

      toast.innerHTML = `
        <div class="toast-icon">${icons[options.type] || icons.info}</div>
        <div class="toast-content">
          ${options.title ? `<div class="toast-title">${options.title}</div>` : ''}
          <div class="toast-message">${options.message}</div>
        </div>
        <button class="toast-close"><i class="fas fa-times"></i></button>
      `;

      this.container.appendChild(toast);

      // Close button
      toast.querySelector('.toast-close').addEventListener('click', () => {
        this.dismiss(toast);
      });

      // Auto dismiss
      if (options.duration !== 0) {
        setTimeout(() => {
          this.dismiss(toast);
        }, options.duration || 5000);
      }

      return toast;
    },

    dismiss: function(toast) {
      toast.style.animation = 'slideOutRight 0.3s ease forwards';
      setTimeout(() => {
        toast.remove();
      }, 300);
    },

    success: function(message, title) {
      return this.show({ type: 'success', message, title });
    },

    error: function(message, title) {
      return this.show({ type: 'error', message, title });
    },

    warning: function(message, title) {
      return this.show({ type: 'warning', message, title });
    },

    info: function(message, title) {
      return this.show({ type: 'info', message, title });
    }
  };

  // Add slideOutRight animation
  const style = document.createElement('style');
  style.textContent = `
    @keyframes slideOutRight {
      from { transform: translateX(0); opacity: 1; }
      to { transform: translateX(100%); opacity: 0; }
    }
  `;
  document.head.appendChild(style);

  // ============= TABLE SORT =============
  function initTableSort() {
    const sortableHeaders = document.querySelectorAll('.data-table th.sortable');

    sortableHeaders.forEach(header => {
      header.addEventListener('click', () => {
        const table = header.closest('.data-table');
        const tbody = table.querySelector('tbody');
        const columnIndex = Array.from(header.parentElement.children).indexOf(header);
        const isAscending = header.classList.contains('sorted-asc');

        // Remove sorted class from all headers
        sortableHeaders.forEach(h => {
          h.classList.remove('sorted', 'sorted-asc', 'sorted-desc');
        });

        // Add sorted class to current header
        header.classList.add('sorted');
        header.classList.add(isAscending ? 'sorted-desc' : 'sorted-asc');

        // Sort rows
        const rows = Array.from(tbody.querySelectorAll('tr'));
        rows.sort((a, b) => {
          const aValue = a.children[columnIndex].textContent.trim();
          const bValue = b.children[columnIndex].textContent.trim();

          // Try to sort as number
          const aNum = parseFloat(aValue.replace(/[^0-9.-]/g, ''));
          const bNum = parseFloat(bValue.replace(/[^0-9.-]/g, ''));

          if (!isNaN(aNum) && !isNaN(bNum)) {
            return isAscending ? bNum - aNum : aNum - bNum;
          }

          // Sort as string
          return isAscending
            ? bValue.localeCompare(aValue)
            : aValue.localeCompare(bValue);
        });

        // Re-append rows
        rows.forEach(row => tbody.appendChild(row));
      });
    });
  }

  // ============= CONFIRM DELETE =============
  function initConfirmDelete() {
    const deleteButtons = document.querySelectorAll('[data-confirm-delete]');

    deleteButtons.forEach(btn => {
      btn.addEventListener('click', (e) => {
        const message = btn.getAttribute('data-confirm-delete') || 'Are you sure you want to delete this item?';

        if (!confirm(message)) {
          e.preventDefault();
          e.stopPropagation();
        }
      });
    });
  }

  // ============= FORM VALIDATION =============
  function initFormValidation() {
    const forms = document.querySelectorAll('form[data-validate]');

    forms.forEach(form => {
      form.addEventListener('submit', (e) => {
        let isValid = true;
        const requiredFields = form.querySelectorAll('[required]');

        requiredFields.forEach(field => {
          removeError(field);

          if (!field.value.trim()) {
            isValid = false;
            showError(field, 'This field is required');
          } else if (field.type === 'email' && !isValidEmail(field.value)) {
            isValid = false;
            showError(field, 'Please enter a valid email');
          }
        });

        if (!isValid) {
          e.preventDefault();
        }
      });
    });

    function showError(field, message) {
      field.classList.add('is-invalid');
      const error = document.createElement('div');
      error.className = 'invalid-feedback';
      error.textContent = message;
      field.parentNode.appendChild(error);
    }

    function removeError(field) {
      field.classList.remove('is-invalid');
      const error = field.parentNode.querySelector('.invalid-feedback');
      if (error) error.remove();
    }

    function isValidEmail(email) {
      return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    }
  }

  // ============= FILE UPLOAD PREVIEW =============
  function initFileUpload() {
    const fileInputs = document.querySelectorAll('input[type="file"][data-preview]');

    fileInputs.forEach(input => {
      input.addEventListener('change', (e) => {
        const previewId = input.getAttribute('data-preview');
        const preview = document.getElementById(previewId);

        if (preview && e.target.files[0]) {
          const reader = new FileReader();
          reader.onload = (e) => {
            preview.src = e.target.result;
            preview.style.display = 'block';
          };
          reader.readAsDataURL(e.target.files[0]);
        }
      });
    });
  }

  // ============= COPY TO CLIPBOARD =============
  window.copyToClipboard = function(text, button) {
    navigator.clipboard.writeText(text).then(() => {
      const originalText = button.innerHTML;
      button.innerHTML = '<i class="fas fa-check"></i> Copied!';
      button.classList.add('btn-success');

      setTimeout(() => {
        button.innerHTML = originalText;
        button.classList.remove('btn-success');
      }, 2000);
    });
  };

  // ============= INITIALIZE ALL =============
  function init() {
    initSidebar();
    initDropdowns();
    initModals();
    initTabs();
    initTableSort();
    initConfirmDelete();
    initFormValidation();
    initFileUpload();
  }

  // Run on DOM ready
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();
