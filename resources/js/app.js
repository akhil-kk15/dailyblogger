import './bootstrap';

// Dark mode toggle functionality
document.addEventListener('DOMContentLoaded', function() {
    console.log('Dark mode script loaded from app.js');
    
    // Alert to test if script is running
    // alert('App.js loaded successfully!');
    
    const html = document.documentElement;
    const toggle = document.getElementById('darkModeToggle');
    const icon = document.getElementById('darkModeIcon');
    
    console.log('Elements found:', {
        html: !!html,
        toggle: !!toggle,
        icon: !!icon
    });
    
    if (!toggle || !icon) {
        console.error('Dark mode toggle elements not found');
        return;
    }
    
    // Clean up old theme keys
    localStorage.removeItem('theme');
    
    // Initialize theme - default to light mode
    function initializeTheme() {
        const savedTheme = localStorage.getItem('app-theme');
        console.log('Initializing theme, saved theme:', savedTheme);
        
        if (savedTheme === 'dark') {
            // Apply dark mode
            html.classList.add('dark');
            icon.textContent = '☀️';
            toggle.style.background = '#fbbf24';
            console.log('Applied dark mode');
        } else {
            // Apply light mode (default)
            html.classList.remove('dark');
            icon.textContent = '🌙';
            toggle.style.background = '#4f46e5';
            localStorage.setItem('app-theme', 'light');
            console.log('Applied light mode');
        }
    }
    
    // Initialize on page load
    initializeTheme();
    
    // Toggle on click
    toggle.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        
        console.log('Dark mode toggle clicked');
        
        if (html.classList.contains('dark')) {
            // Switch to light mode
            html.classList.remove('dark');
            icon.textContent = '🌙';
            toggle.style.background = '#4f46e5';
            localStorage.setItem('app-theme', 'light');
            console.log('Switched to light mode');
        } else {
            // Switch to dark mode
            html.classList.add('dark');
            icon.textContent = '☀️';
            toggle.style.background = '#fbbf24';
            localStorage.setItem('app-theme', 'dark');
            console.log('Switched to dark mode');
        }
    });
    
    // Add hover effects
    toggle.addEventListener('mouseenter', function() {
        this.style.transform = 'scale(1.1)';
    });
    
    toggle.addEventListener('mouseleave', function() {
        this.style.transform = 'scale(1)';
    });
    
    console.log('Dark mode toggle setup complete');
});
