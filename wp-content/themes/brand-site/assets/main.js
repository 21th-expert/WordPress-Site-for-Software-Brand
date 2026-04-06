document.addEventListener('DOMContentLoaded', function () {
    const toggle = document.getElementById('nav-toggle');
    const mobileNav = document.getElementById('mobile-nav');
    if (toggle && mobileNav) {
        toggle.addEventListener('click', function () {
            mobileNav.classList.toggle('open');
            const open = mobileNav.classList.contains('open');
            toggle.setAttribute('aria-expanded', open);
            toggle.querySelector('.icon-open').style.display  = open ? 'none'  : 'block';
            toggle.querySelector('.icon-close').style.display = open ? 'block' : 'none';
        });
    }

    // Close mobile nav on link click
    document.querySelectorAll('#mobile-nav a').forEach(function (link) {
        link.addEventListener('click', function () {
            mobileNav.classList.remove('open');
            toggle.setAttribute('aria-expanded', 'false');
            toggle.querySelector('.icon-open').style.display  = 'block';
            toggle.querySelector('.icon-close').style.display = 'none';
        });
    });

    // Highlight active nav link
    const currentPath = window.location.pathname;
    document.querySelectorAll('.nav-links a, #mobile-nav a').forEach(function (link) {
        if (link.getAttribute('href') === currentPath) link.classList.add('active');
    });
});
