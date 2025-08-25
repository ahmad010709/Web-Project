// ======================================
// MAIN NAVIGATION AND MENU FUNCTIONALITY
// ======================================

/**
 * VARIABLE DECLARATIONS AND DOM ELEMENT SELECTION
 * ============================================
 * - 'let' keyword: Creates block-scoped variables that can be reassigned
 * - 'document.querySelector()': Returns the first element matching the CSS selector
 * - '#menu-icon': CSS ID selector syntax (# indicates an ID)
 * - '.navbar': CSS class selector syntax (. indicates a class)
 */

// Select the hamburger menu icon element by its ID
let menu = document.querySelector('#menu-icon');

// Select the navigation bar element by its class name
let navbar = document.querySelector('.navbar');

/**
 * CONDITIONAL STATEMENT AND EVENT HANDLING
 * =======================================
 * - 'if' statement: Executes code only if condition is true
 * - '&&' operator: Logical AND - returns true only if both operands are truthy
 * - 'onclick' property: Event handler property for click events
 * - Arrow functions '=>': Modern ES6 syntax for function expressions
 * - 'classList.toggle()': Adds class if not present, removes if present
 * - 'classList.remove()': Removes specified class from element
 * - 'window.onscroll': Global event handler for scroll events
 */

// Check if both menu and navbar elements exist in the DOM before adding event listeners
if (menu && navbar) {
    // Assign click event handler using arrow function syntax
    menu.onclick = () => {
        // Toggle the 'bx-x' class on menu icon (changes hamburger to X icon)
        menu.classList.toggle('bx-x');
        
        // Toggle the 'active' class on navbar (shows/hides navigation menu)
        navbar.classList.toggle('active');
    }

    // Assign scroll event handler to close menu when user scrolls
    window.onscroll = () => {
        // Remove 'bx-x' class to reset menu icon to hamburger state
        menu.classList.remove('bx-x');
        
        // Remove 'active' class to hide the navigation menu
        navbar.classList.remove('active');
    }
}

// ======================================
// TYPED.JS ANIMATIONS FOR HOME PAGE
// ======================================

/**
 * LIBRARY AVAILABILITY CHECK AND TYPED.JS IMPLEMENTATION
 * =====================================================
 * - 'typeof' operator: Returns a string indicating the type of operand
 * - '!==' operator: Strict inequality comparison (checks value and type)
 * - 'undefined': Primitive value representing absence of value
 * - 'const' keyword: Creates block-scoped constants (cannot be reassigned)
 * - 'new' operator: Creates instance of constructor function/class
 * - Object literal '{}': Creates objects with key-value pairs
 * - Array literal '[]': Creates arrays with comma-separated values
 * - Boolean literal 'true': Primitive boolean value
 */

// Check if the Typed.js library is loaded before attempting to use it
if (typeof Typed !== 'undefined') {
    
    /**
     * HOME PAGE TYPING ANIMATION SETUP
     * ===============================
     * Creates a typewriter effect for the home page main text
     */
    
    // Select the home page typing element and store reference
    const homeElement = document.querySelector('.home-mt');
    
    // Only create Typed instance if the target element exists in DOM
    if (homeElement) {
        // Create new Typed.js instance with configuration object
        const home = new Typed('.home-mt', {
            // Array of strings to be typed out sequentially
            strings: ['OS Linus Tools','Websites','Web/Apps Designs','Python Projects'],
            
            // Speed of typing in milliseconds per character
            typeSpeed: 80,
            
            // Speed of backspacing in milliseconds per character
            backSpeed: 80,
            
            // Delay before starting to backspace in milliseconds
            backDelay: 1200,
            
            // Boolean: whether to loop the animation infinitely
            loop: true,
        });
    }

    /**
     * COURSE PAGES TYPING ANIMATIONS
     * =============================
     * Multiple Typed.js instances for different course page sections
     */

    // YouTube courses page typing animation
    const cyElement = document.querySelector('.cours-y');
    if (cyElement) {
        const cy = new Typed('.cours-y', {
            strings: ['MY YouTube Courses '],
            typeSpeed: 80,
            backSpeed: 80,
            backDelay: 1200,
            loop: true,
        });
    }

    // Website courses page typing animation
    const cwElement = document.querySelector('.cours-w');
    if (cwElement) {
        const cw = new Typed('.cours-w', {
            strings: ['My Website Courses '],
            typeSpeed: 80,
            backSpeed: 80,
            backDelay: 1200,
            loop: true,
        });
    }

    // Other courses page typing animation
    const coElement = document.querySelector('.cours-o');
    if (coElement) {
        const co = new Typed('.cours-o', {
            strings: ['Other Courses '],
            typeSpeed: 80,
            backSpeed: 80,
            backDelay: 1200,
            loop: true,
        });
    }
}

// ======================================
// COURSES PAGE FUNCTIONALITY
// ======================================

// DOM Elements for courses page
const menuIcon = document.querySelector('.menu-icon');
const sidebar = document.querySelector('.sidebar');
const mainContent = document.querySelector('.main-content');
const tabs = document.querySelectorAll('.tab');
const sidebarTabs = document.querySelectorAll('.sidebar-tab');
const videoCards = document.querySelectorAll('.video-card');

// Toggle sidebar visibility on mobile (courses page)
if (menuIcon && sidebar) {
    menuIcon.addEventListener('click', () => {
        // Check if we're on mobile (using window width as indicator)
        const isMobile = window.innerWidth <= 778;
        
        if (isMobile) {
            // Toggle the 'active' class on the sidebar for mobile view
            sidebar.classList.toggle('active');
        }
        // Don't do anything special on desktop - keep the sidebar visible as normal
    });
}

// Sidebar Category Tab Switching
if (sidebarTabs.length > 0) {
    sidebarTabs.forEach(tab => {
        tab.addEventListener('click', () => {
            // Remove active class from all sidebar tabs
            sidebarTabs.forEach(t => t.classList.remove('active'));
            
            // Add active class to clicked sidebar tab
            tab.classList.add('active');
            
            // Get the selected category
            const category = tab.textContent.trim();
            
            // Update the content header to reflect the selected category
            const contentHeader = document.querySelector('.content-header h2');
            if (contentHeader) {
                if (category === 'All') {
                    contentHeader.textContent = 'Channels Name';
                } else {
                    contentHeader.textContent = category;
                }
            }
            
            // Also update the main category tabs to match the sidebar selection
            tabs.forEach(mainTab => {
                if (mainTab.textContent.trim() === category) {
                    // Remove active class from all main tabs
                    tabs.forEach(t => t.classList.remove('active'));
                    // Add active class to matching main tab
                    mainTab.classList.add('active');
                }
            });
            
            console.log(`Sidebar category selected: ${category}`);
            
            // Here you would typically filter video content based on the selected category
            // For example: filterVideosByCategory(category);
        });
    });
}

// Sidebar item selection
const sidebarItems = document.querySelectorAll('.sidebar-item');
if (sidebarItems.length > 0) {
    sidebarItems.forEach(item => {
        item.addEventListener('click', () => {
            // Remove active class from all items
            sidebarItems.forEach(i => i.classList.remove('active'));
            
            // Add active class to clicked item
            item.classList.add('active');
            
            // Here you would typically load different content based on the selected item
            console.log(`Sidebar item clicked: ${item.textContent.trim()}`);
        });
    });
}

// Close sidebar when clicking outside of it on mobile
if (sidebar && menuIcon) {
    document.addEventListener('click', (e) => {
        const isMobile = window.innerWidth <= 768;
        if (isMobile && sidebar.classList.contains('active')) {
            // Check if the click is outside the sidebar and not on the menu icon
            if (!sidebar.contains(e.target) && !menuIcon.contains(e.target)) {
                sidebar.classList.remove('active');
            }
        }
    });
}

// Make sure sidebar is properly initialized on page load
window.addEventListener('DOMContentLoaded', () => {
    if (sidebar) {
        // Check if we're on mobile on initial load
        const isMobile = window.innerWidth <= 768;
        
        if (isMobile) {
            // Make sure sidebar is in the correct initial state on mobile
            sidebar.classList.remove('active');
            sidebar.style.left = ''; // Ensure CSS handles the positioning
        }
    }
});

// Handle window resize to reset sidebar state
window.addEventListener('resize', () => {
    if (sidebar && mainContent) {
        const isMobile = window.innerWidth <= 758;
        
        if (isMobile) {
            // On mobile: reset any desktop-specific styles
            sidebar.style.width = '';
            mainContent.style.marginLeft = '';
            document.querySelectorAll('.sidebar-item span').forEach(span => {
                span.style.display = '';
            });
            
            // Ensure sidebar is properly hidden on initial mobile view
            if (!sidebar.classList.contains('active')) {
                sidebar.style.left = '-220px';
            }
        } else {
            // On desktop: reset mobile-specific styles
            sidebar.classList.remove('active');
            sidebar.style.left = ''; // Reset inline style
        }
    }
});

// Function to filter videos by category (placeholder implementation)
function filterVideosByCategory(category) {
    // Get all video cards
    const videos = document.querySelectorAll('.video-card');
    
    // If 'All' is selected, show all videos
    if (category === 'All') {
        videos.forEach(video => {
            video.style.display = 'block';
        });
        return;
    }
    
    // Otherwise, filter based on category
    videos.forEach(video => {
        const channelName = video.querySelector('.channel-name');
        if (channelName && channelName.textContent === category) {
            video.style.display = 'block';
        } else {
            video.style.display = 'none';
        }
    });
}

// Video card hover effects
if (videoCards.length > 0) {
    videoCards.forEach(card => {
        card.addEventListener('mouseenter', () => {
            card.style.transform = 'translateY(-5px)';
            card.style.boxShadow = '0 10px 20px rgba(0, 0, 0, 0.3)';
        });
        
        card.addEventListener('mouseleave', () => {
            card.style.transform = 'translateY(0)';
            card.style.boxShadow = 'none';
        });
        
        // Add click event to video cards
        card.addEventListener('click', () => {
            const videoTitle = card.querySelector('.video-title');
            if (videoTitle) {
                console.log(`Video clicked: ${videoTitle.textContent}`);
                // Here you would typically navigate to the video page
            }
        });
    });
}

// ======================================
// VIDEO PLAYER FUNCTIONALITY
// ======================================

// Function to open video (used by course pages)
function openVideo(src, title, channel) {
    // Encode the parameters to ensure they work in a URL
    const encodedSrc = encodeURIComponent(src);
    const encodedTitle = encodeURIComponent(title);
    const encodedChannel = encodeURIComponent(channel);

    // Navigate to the watch page with the parameters
    window.location.href = `watch.html?src=${encodedSrc}&title=${encodedTitle}&channel=${encodedChannel}`;
}

// Make openVideo function globally accessible
window.openVideo = openVideo;

// ======================================
// GOOGLE ANALYTICS (if needed)
// ======================================

// Google Analytics initialization
if (typeof gtag === 'function') {
    window.dataLayer = window.dataLayer || [];
    function gtag() { dataLayer.push(arguments); }
    gtag('js', new Date());
    gtag('config', 'G-5M2XQB5KVD');
}

