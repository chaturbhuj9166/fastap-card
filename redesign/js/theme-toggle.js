/**
 * FASTAP - Theme Toggle
 * Dark/Light Mode Switcher with System Preference Detection
 */

(function() {
  'use strict';

  // ============= THEME MANAGER =============
  const ThemeManager = {
    // Get stored theme or detect system preference
    getPreferredTheme() {
      const storedTheme = localStorage.getItem('fastap-theme');
      if (storedTheme) {
        return storedTheme;
      }

      // Auto-detect system preference
      if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
        return 'dark';
      }

      return 'light';
    },

    // Set theme on document
    setTheme(theme) {
      document.documentElement.setAttribute('data-theme', theme);
      localStorage.setItem('fastap-theme', theme);
      this.updateMetaThemeColor(theme);
    },

    // Update meta theme-color for mobile browsers
    updateMetaThemeColor(theme) {
      const metaThemeColor = document.querySelector('meta[name="theme-color"]');
      if (metaThemeColor) {
        metaThemeColor.setAttribute('content', theme === 'dark' ? '#0f0f1e' : '#ffffff');
      }
    },

    // Toggle between dark and light
    toggleTheme() {
      const currentTheme = document.documentElement.getAttribute('data-theme') || 'light';
      const newTheme = currentTheme === 'dark' ? 'light' : 'dark';

      // Add transition class
      document.body.classList.add('theme-transitioning');

      this.setTheme(newTheme);

      // Remove transition class after animation
      setTimeout(() => {
        document.body.classList.remove('theme-transitioning');
      }, 500);

      return newTheme;
    },

    // Initialize theme on page load
    init() {
      const theme = this.getPreferredTheme();
      this.setTheme(theme);
      this.setupListeners();
    },

    // Setup event listeners
    setupListeners() {
      // Listen for system theme changes
      if (window.matchMedia) {
        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
          // Only auto-update if user hasn't manually set a preference
          if (!localStorage.getItem('fastap-theme')) {
            this.setTheme(e.matches ? 'dark' : 'light');
          }
        });
      }

      // Setup toggle button click handlers
      document.addEventListener('click', (e) => {
        if (e.target.closest('.theme-toggle')) {
          e.preventDefault();
          this.toggleTheme();
        }
      });
    }
  };

  // Initialize theme immediately (before DOM loads) to prevent flash
  ThemeManager.setTheme(ThemeManager.getPreferredTheme());

  // Initialize fully when DOM is ready
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => ThemeManager.init());
  } else {
    ThemeManager.init();
  }

  // Expose to global scope if needed
  window.ThemeManager = ThemeManager;

})();
