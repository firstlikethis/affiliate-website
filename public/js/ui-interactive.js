/**
 * UI Interactive Elements - Enhancing User Experience
 * For Affiliate Website with Laravel
 */

document.addEventListener('DOMContentLoaded', function() {
    // Mobile Menu Toggle
    setupMobileMenu();
    
    // Lazy Loading Images
    setupLazyLoading();
    
    // Smooth Scroll for Anchor Links
    setupSmoothScroll();
    
    // Product Card Hover Effects
    setupProductCardEffects();
    
    // Dropdown Menus
    setupDropdowns();
    
    // Back to Top Button
    setupBackToTop();
    
    // Share Buttons
    setupShareButtons();
    
    // Modal Dialogs
    setupModals();
    
    // Newsletter Form Validation
    setupNewsletterForm();
});

/**
 * Setup Mobile Menu Toggle Functionality
 */
function setupMobileMenu() {
    const mobileMenuButton = document.querySelector('[onclick="toggleMobileMenu()"]');
    const mobileMenu = document.getElementById('mobile-menu');
    
    if (!mobileMenuButton || !mobileMenu) return;
    
    // Already defined in layout
}

/**
 * Setup Lazy Loading for Images
 */
function setupLazyLoading() {
    // Check if IntersectionObserver is supported
    if ('IntersectionObserver' in window) {
        const lazyImages = document.querySelectorAll('img.lazy');
        
        const imageObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const lazyImage = entry.target;
                    lazyImage.src = lazyImage.dataset.src;
                    lazyImage.classList.remove('lazy');
                    imageObserver.unobserve(lazyImage);
                }
            });
        });
        
        lazyImages.forEach(image => {
            imageObserver.observe(image);
        });
    } else {
        // Fallback for browsers that don't support IntersectionObserver
        const lazyImages = document.querySelectorAll('img.lazy');
        
        function lazyLoad() {
            lazyImages.forEach(image => {
                if (image.getBoundingClientRect().top <= window.innerHeight && 
                    image.getBoundingClientRect().bottom >= 0 && 
                    getComputedStyle(image).display !== 'none') {
                    image.src = image.dataset.src;
                    image.classList.remove('lazy');
                }
            });
            
            if (lazyImages.length === 0) { 
                document.removeEventListener('scroll', lazyLoad);
                window.removeEventListener('resize', lazyLoad);
                window.removeEventListener('orientationChange', lazyLoad);
            }
        }
        
        document.addEventListener('scroll', lazyLoad);
        window.addEventListener('resize', lazyLoad);
        window.addEventListener('orientationChange', lazyLoad);
        
        // Initial load
        lazyLoad();
    }
}

/**
 * Setup Smooth Scrolling for Anchor Links
 */
function setupSmoothScroll() {
    const anchorLinks = document.querySelectorAll('a[href^="#"]:not([href="#"])');
    
    anchorLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href');
            const targetElement = document.querySelector(targetId);
            
            if (targetElement) {
                window.scrollTo({
                    top: targetElement.offsetTop - 80, // Adjust for header height
                    behavior: 'smooth'
                });
            }
        });
    });
}

/**
 * Setup Product Card Hover Effects
 */
function setupProductCardEffects() {
    const productCards = document.querySelectorAll('.hover-up');
    
    productCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.classList.add('shadow-lg');
        });
        
        card.addEventListener('mouseleave', function() {
            this.classList.remove('shadow-lg');
        });
    });
}

/**
 * Setup Dropdown Menus
 */
function setupDropdowns() {
    const dropdownButtons = document.querySelectorAll('[data-dropdown-toggle]');
    
    dropdownButtons.forEach(button => {
        button.addEventListener('click', function() {
            const targetId = this.getAttribute('data-dropdown-toggle');
            const target = document.getElementById(targetId);
            
            if (target) {
                target.classList.toggle('hidden');
            }
        });
    });
    
    // Close dropdowns when clicking outside
    document.addEventListener('click', function(event) {
        const isDropdownButton = event.target.closest('[data-dropdown-toggle]');
        
        if (!isDropdownButton) {
            const openDropdowns = document.querySelectorAll('[data-dropdown]:not(.hidden)');
            openDropdowns.forEach(dropdown => {
                dropdown.classList.add('hidden');
            });
        }
    });
}

/**
 * Setup Back to Top Button
 */
function setupBackToTop() {
    // Create back to top button
    const backToTopButton = document.createElement('button');
    backToTopButton.innerHTML = '<i class="fas fa-arrow-up"></i>';
    backToTopButton.className = 'fixed bottom-6 right-6 bg-purple-600 text-white w-12 h-12 rounded-full shadow-lg flex items-center justify-center opacity-0 transition-opacity duration-300 z-50';
    backToTopButton.id = 'back-to-top';
    document.body.appendChild(backToTopButton);
    
    // Show/hide based on scroll position
    window.addEventListener('scroll', function() {
        if (window.pageYOffset > 300) {
            backToTopButton.classList.remove('opacity-0');
            backToTopButton.classList.add('opacity-100');
        } else {
            backToTopButton.classList.remove('opacity-100');
            backToTopButton.classList.add('opacity-0');
        }
    });
    
    // Scroll to top when clicked
    backToTopButton.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
}

/**
 * Setup Share Buttons
 */
function setupShareButtons() {
    const shareButtons = document.querySelectorAll('[data-share]');
    
    shareButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            
            const shareType = this.getAttribute('data-share');
            const shareUrl = encodeURIComponent(window.location.href);
            const shareTitle = encodeURIComponent(document.title);
            
            let shareLink = '';
            
            switch(shareType) {
                case 'facebook':
                    shareLink = `https://www.facebook.com/sharer/sharer.php?u=${shareUrl}`;
                    break;
                case 'twitter':
                    shareLink = `https://twitter.com/intent/tweet?url=${shareUrl}&text=${shareTitle}`;
                    break;
                case 'line':
                    shareLink = `https://line.me/R/msg/text/?${shareTitle}%0D%0A${shareUrl}`;
                    break;
                case 'email':
                    shareLink = `mailto:?subject=${shareTitle}&body=${shareUrl}`;
                    break;
            }
            
            if (shareLink) {
                window.open(shareLink, '_blank');
            }
        });
    });
}

/**
 * Setup Modal Dialogs
 */
function setupModals() {
    const modalTriggers = document.querySelectorAll('[data-modal-target]');
    const closeModalButtons = document.querySelectorAll('[data-close-modal]');
    
    // Open modals
    modalTriggers.forEach(trigger => {
        trigger.addEventListener('click', function() {
            const modalId = this.getAttribute('data-modal-target');
            const modal = document.getElementById(modalId);
            
            if (modal) {
                modal.classList.remove('hidden');
                document.body.classList.add('overflow-hidden');
                
                // Animate modal
                setTimeout(() => {
                    const modalContent = modal.querySelector('.modal-content');
                    if (modalContent) {
                        modalContent.classList.remove('opacity-0');
                        modalContent.classList.remove('translate-y-4');
                    }
                }, 10);
            }
        });
    });
    
    // Close modals
    closeModalButtons.forEach(button => {
        button.addEventListener('click', closeModal);
    });
    
    // Close when clicking outside
    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('modal-backdrop')) {
            closeModal();
        }
    });
    
    // Close with Escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeModal();
        }
    });
    
    function closeModal() {
        const openModals = document.querySelectorAll('.modal-backdrop:not(.hidden)');
        
        openModals.forEach(modal => {
            const modalContent = modal.querySelector('.modal-content');
            
            if (modalContent) {
                modalContent.classList.add('opacity-0');
                modalContent.classList.add('translate-y-4');
            }
            
            setTimeout(() => {
                modal.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            }, 300);
        });
    }
}

/**
 * Setup Newsletter Form Validation
 */
function setupNewsletterForm() {
    const newsletterForms = document.querySelectorAll('form.newsletter-form');
    
    newsletterForms.forEach(form => {
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            
            const emailInput = this.querySelector('input[type="email"]');
            const submitButton = this.querySelector('button[type="submit"]');
            
            if (emailInput && isValidEmail(emailInput.value)) {
                // Show success message
                const successMessage = document.createElement('div');
                successMessage.className = 'text-green-500 text-sm mt-2';
                successMessage.textContent = 'ขอบคุณสำหรับการสมัครรับข่าวสาร!';
                
                // Replace button with success message
                submitButton.insertAdjacentElement('afterend', successMessage);
                submitButton.classList.add('hidden');
                
                // Reset form
                setTimeout(() => {
                    form.reset();
                    successMessage.remove();
                    submitButton.classList.remove('hidden');
                }, 3000);
            } else if (emailInput) {
                // Show error
                emailInput.classList.add('border-red-500');
                
                const errorMessage = document.createElement('div');
                errorMessage.className = 'text-red-500 text-sm mt-1';
                errorMessage.textContent = 'กรุณากรอกอีเมลให้ถูกต้อง';
                
                // Remove any existing error message
                const existingError = emailInput.nextElementSibling;
                if (existingError && existingError.classList.contains('text-red-500')) {
                    existingError.remove();
                }
                
                emailInput.insertAdjacentElement('afterend', errorMessage);
                
                // Remove error on input
                emailInput.addEventListener('input', function() {
                    if (isValidEmail(this.value)) {
                        this.classList.remove('border-red-500');
                        if (errorMessage) {
                            errorMessage.remove();
                        }
                    }
                });
            }
        });
    });
    
    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }
}