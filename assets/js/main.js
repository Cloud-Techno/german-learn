/**
 * German Learn Platform - Main JavaScript
 * Minimal, Performance-Focused, Vanilla JS
 */

(function() {
    'use strict';
    
    // ============================================
    // Mobile Menu Toggle
    // ============================================
    const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
    const mainNav = document.getElementById('main-nav');
    
    if (mobileMenuToggle && mainNav) {
        mobileMenuToggle.addEventListener('click', function() {
            mainNav.classList.toggle('active');
            this.classList.toggle('active');
        });
    }
    
    // ============================================
    // Language Dropdown (keep open on hover)
    // ============================================
    const langToggle = document.getElementById('lang-toggle');
    const langDropdown = document.getElementById('lang-dropdown');
    
    if (langToggle && langDropdown) {
        let timeout;
        
        langToggle.addEventListener('mouseenter', function() {
            clearTimeout(timeout);
            langDropdown.style.display = 'block';
        });
        
        const langSwitcher = langToggle.closest('.language-switcher');
        if (langSwitcher) {
            langSwitcher.addEventListener('mouseleave', function() {
                timeout = setTimeout(function() {
                    langDropdown.style.display = 'none';
                }, 200);
            });
        }
    }
    
    // ============================================
    // Lazy Loading for Images (if any)
    // ============================================
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver(function(entries, observer) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    if (img.dataset.src) {
                        img.src = img.dataset.src;
                        img.removeAttribute('data-src');
                    }
                    observer.unobserve(img);
                }
            });
        });
        
        document.querySelectorAll('img[data-src]').forEach(function(img) {
            imageObserver.observe(img);
        });
    }
    
    // ============================================
    // Smooth Scroll for Anchor Links
    // ============================================
    document.querySelectorAll('a[href^="#"]').forEach(function(anchor) {
        anchor.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            if (href !== '#' && href.length > 1) {
                const target = document.querySelector(href);
                if (target) {
                    e.preventDefault();
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            }
        });
    });
    
    // ============================================
    // AdSense Auto Ads (if needed)
    // ============================================
    // Google AdSense will automatically inject ads
    // No manual intervention needed
    
    // ============================================
    // Performance: Preload Critical Resources
    // ============================================
    // This is handled via HTML <link rel="preconnect"> tags
    
    // ============================================
    // Analytics & Tracking (placeholder)
    // ============================================
    // Add Google Analytics or other tracking here if needed
    // Example:
    // if (typeof gtag !== 'undefined') {
    //     gtag('config', 'GA_MEASUREMENT_ID');
    // }
    
    console.log('German Learn Platform - JS Loaded');
})();
