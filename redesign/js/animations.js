/**
 * FASTAP - Smooth Animations
 * Scroll animations and hover effects using Intersection Observer
 */

(function() {
  'use strict';

  // ============= SCROLL REVEAL ANIMATIONS =============
  const ScrollAnimations = {
    // Initialize scroll reveal
    init() {
      this.setupIntersectionObserver();
      this.setupSmoothScroll();
      this.setupCounterAnimations();
    },

    // Setup Intersection Observer for scroll reveals
    setupIntersectionObserver() {
      // Check if Intersection Observer is supported
      if (!('IntersectionObserver' in window)) {
        return; // Gracefully degrade - show all content
      }

      const observerOptions = {
        root: null,
        rootMargin: '0px',
        threshold: 0.1
      };

      const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            entry.target.classList.add('is-visible');
            // Optionally stop observing after animation
            if (!entry.target.classList.contains('repeat-animation')) {
              observer.unobserve(entry.target);
            }
          }
        });
      }, observerOptions);

      // Observe all elements with animation classes
      const animatedElements = document.querySelectorAll(
        '.fade-up, .fade-in, .fade-left, .fade-right, .scale-in, .slide-up'
      );

      animatedElements.forEach(el => {
        observer.observe(el);
      });

      // Staggered animations for lists/grids
      const staggerGroups = document.querySelectorAll('.stagger-animation');
      staggerGroups.forEach(group => {
        const children = Array.from(group.children);
        children.forEach((child, index) => {
          child.style.transitionDelay = `${index * 0.1}s`;
          observer.observe(child);
        });
      });
    },

    // Smooth scroll for anchor links
    setupSmoothScroll() {
      document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
          const href = this.getAttribute('href');
          if (href === '#' || href === '#!') return;

          const target = document.querySelector(href);
          if (target) {
            e.preventDefault();
            const headerOffset = 80;
            const elementPosition = target.getBoundingClientRect().top;
            const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

            window.scrollTo({
              top: offsetPosition,
              behavior: 'smooth'
            });
          }
        });
      });
    },

    // Animated counters for statistics
    setupCounterAnimations() {
      const counters = document.querySelectorAll('.stat-number[data-count]');

      if (!counters.length) return;

      const animateCounter = (counter) => {
        const target = parseInt(counter.getAttribute('data-count'));
        const duration = 2000;
        const step = target / (duration / 16);
        let current = 0;

        const updateCounter = () => {
          current += step;
          if (current < target) {
            counter.textContent = Math.floor(current).toLocaleString();
            requestAnimationFrame(updateCounter);
          } else {
            counter.textContent = target.toLocaleString();
          }
        };

        updateCounter();
      };

      const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting && !entry.target.classList.contains('counted')) {
            entry.target.classList.add('counted');
            animateCounter(entry.target);
            observer.unobserve(entry.target);
          }
        });
      }, { threshold: 0.5 });

      counters.forEach(counter => observer.observe(counter));
    }
  };

  // ============= PARALLAX EFFECT =============
  const ParallaxEffect = {
    init() {
      const parallaxElements = document.querySelectorAll('[data-parallax]');

      if (!parallaxElements.length) return;

      let ticking = false;

      const updateParallax = () => {
        const scrolled = window.pageYOffset;

        parallaxElements.forEach(el => {
          const speed = parseFloat(el.getAttribute('data-parallax')) || 0.5;
          const offset = scrolled * speed;
          el.style.transform = `translateY(${offset}px)`;
        });

        ticking = false;
      };

      window.addEventListener('scroll', () => {
        if (!ticking) {
          window.requestAnimationFrame(updateParallax);
          ticking = true;
        }
      });
    }
  };

  // ============= HEADER SCROLL EFFECT =============
  const HeaderEffect = {
    init() {
      const header = document.querySelector('header');
      if (!header) return;

      let lastScroll = 0;

      window.addEventListener('scroll', () => {
        const currentScroll = window.pageYOffset;

        // Add scrolled class when scrolled down
        if (currentScroll > 50) {
          header.classList.add('scrolled');
        } else {
          header.classList.remove('scrolled');
        }

        // Optional: Hide header on scroll down, show on scroll up
        if (currentScroll > lastScroll && currentScroll > 500) {
          header.classList.add('header-hidden');
        } else {
          header.classList.remove('header-hidden');
        }

        lastScroll = currentScroll;
      });
    }
  };

  // ============= INITIALIZE ALL =============
  const initializeAnimations = () => {
    ScrollAnimations.init();
    ParallaxEffect.init();
    HeaderEffect.init();
  };

  // Initialize when DOM is ready
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initializeAnimations);
  } else {
    initializeAnimations();
  }

})();

/* ============= CSS ANIMATION CLASSES =============
   Add these classes to elements you want to animate:

   .fade-up       - Fade in from bottom
   .fade-in       - Simple fade in
   .fade-left     - Fade in from left
   .fade-right    - Fade in from right
   .scale-in      - Scale up fade in
   .slide-up      - Slide up animation

   Optional attributes:
   data-parallax="0.5"  - Add parallax effect (speed value)
   data-count="1000"    - Animate counter to this number
*/
