document.addEventListener('DOMContentLoaded', function () {

    /* ── Scroll progress bar ─────────────────────────────── */
    const progressBar = document.createElement('div');
    progressBar.id = 'scroll-progress';
    document.body.prepend(progressBar);

    /* ── Back to top button ──────────────────────────────── */
    const backToTop = document.createElement('button');
    backToTop.id = 'back-to-top';
    backToTop.setAttribute('aria-label', 'Back to top');
    backToTop.innerHTML = '↑';
    document.body.appendChild(backToTop);
    backToTop.addEventListener('click', function () {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });

    /* ── Skip to content ─────────────────────────────────── */
    const skip = document.createElement('a');
    skip.href = '#main-content';
    skip.className = 'skip-link';
    skip.textContent = 'Skip to content';
    document.body.prepend(skip);

    /* ── Scroll events ───────────────────────────────────── */
    const header = document.querySelector('.site-header');
    window.addEventListener('scroll', function () {
        const scrolled = window.scrollY;
        const total    = document.documentElement.scrollHeight - window.innerHeight;
        const pct      = total > 0 ? (scrolled / total) * 100 : 0;

        progressBar.style.width = pct + '%';

        if (scrolled > 400) {
            backToTop.classList.add('visible');
        } else {
            backToTop.classList.remove('visible');
        }

        if (header) {
            header.classList.toggle('scrolled', scrolled > 10);
        }
    }, { passive: true });

    /* ── Mobile nav toggle ───────────────────────────────── */
    const toggle    = document.getElementById('nav-toggle');
    const mobileNav = document.getElementById('mobile-nav');
    if (toggle && mobileNav) {
        toggle.addEventListener('click', function () {
            const open = mobileNav.classList.toggle('open');
            toggle.setAttribute('aria-expanded', open);
            const iconOpen  = toggle.querySelector('.icon-open');
            const iconClose = toggle.querySelector('.icon-close');
            if (iconOpen)  iconOpen.style.display  = open ? 'none'  : 'block';
            if (iconClose) iconClose.style.display = open ? 'block' : 'none';
        });
        document.querySelectorAll('#mobile-nav a').forEach(function (link) {
            link.addEventListener('click', function () {
                mobileNav.classList.remove('open');
                toggle.setAttribute('aria-expanded', 'false');
                const iconOpen  = toggle.querySelector('.icon-open');
                const iconClose = toggle.querySelector('.icon-close');
                if (iconOpen)  iconOpen.style.display  = 'block';
                if (iconClose) iconClose.style.display = 'none';
            });
        });
    }

    /* ── Active nav link ─────────────────────────────────── */
    const currentPath = window.location.pathname;
    document.querySelectorAll('.nav-links a, #mobile-nav a').forEach(function (link) {
        const href = link.getAttribute('href');
        if (href && (href === currentPath || (href !== '/' && currentPath.startsWith(href)))) {
            link.classList.add('active');
        }
    });

    /* ── Scroll reveal ───────────────────────────────────── */
    const revealEls = document.querySelectorAll('.reveal, .reveal-left, .reveal-right');
    if ('IntersectionObserver' in window) {
        const observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12 });
        revealEls.forEach(function (el) { observer.observe(el); });
    } else {
        revealEls.forEach(function (el) { el.classList.add('visible'); });
    }

    /* ── Auto-add reveal to sections ────────────────────── */
    document.querySelectorAll(
        '.card, .testimonial-card, .pricing-card, .resource-card, .team-card, .product-item, .stat-item'
    ).forEach(function (el, i) {
        if (!el.classList.contains('reveal')) {
            el.classList.add('reveal');
            el.style.transitionDelay = (i % 4 * 0.1) + 's';
        }
    });

    /* ── Animated stat counters ──────────────────────────── */
    function animateCounter(el) {
        const text   = el.textContent.trim();
        const match  = text.match(/([\d.]+)/);
        if (!match) return;
        const target  = parseFloat(match[1]);
        const suffix  = text.replace(match[1], '');
        const isFloat = match[1].includes('.');
        const duration = 1800;
        const start    = performance.now();

        function update(now) {
            const elapsed = now - start;
            const progress = Math.min(elapsed / duration, 1);
            const ease = 1 - Math.pow(1 - progress, 3);
            const current = target * ease;
            el.textContent = (isFloat ? current.toFixed(1) : Math.floor(current)) + suffix;
            if (progress < 1) requestAnimationFrame(update);
        }
        requestAnimationFrame(update);
    }

    const statNums = document.querySelectorAll('.stat-num, .hero-stat-num');
    if ('IntersectionObserver' in window) {
        const statObserver = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    animateCounter(entry.target);
                    statObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });
        statNums.forEach(function (el) { statObserver.observe(el); });
    }

    /* ── Contact form AJAX submit ────────────────────────── */
    const contactForm = document.getElementById('contact-form');
    if (contactForm) {
        contactForm.addEventListener('submit', function (e) {
            e.preventDefault();
            const btn     = contactForm.querySelector('.form-submit');
            const success = document.getElementById('form-success');
            const origText = btn.textContent;

            btn.textContent = 'Sending…';
            btn.disabled = true;

            const data = new FormData(contactForm);
            data.append('action', 'brandsite_contact');
            data.append('nonce', brandsiteVars.nonce);

            fetch(brandsiteVars.ajaxUrl, { method: 'POST', body: data })
                .then(function (r) { return r.json(); })
                .then(function (res) {
                    if (res.success) {
                        contactForm.style.display = 'none';
                        if (success) success.style.display = 'block';
                        showToast('Message sent! We\'ll reply within 24 hours. ✓');
                    } else {
                        showToast('Something went wrong. Please try again.', true);
                        btn.textContent = origText;
                        btn.disabled = false;
                    }
                })
                .catch(function () {
                    showToast('Network error. Please try again.', true);
                    btn.textContent = origText;
                    btn.disabled = false;
                });
        });
    }

    /* ── Toast notification ──────────────────────────────── */
    function showToast(msg, isError) {
        let toast = document.getElementById('toast');
        if (!toast) {
            toast = document.createElement('div');
            toast.id = 'toast';
            document.body.appendChild(toast);
        }
        toast.textContent = msg;
        toast.className = isError ? 'error' : '';
        setTimeout(function () { toast.classList.add('show'); }, 10);
        setTimeout(function () {
            toast.classList.remove('show');
        }, 4000);
    }

    /* ── Cookie banner ───────────────────────────────────── */
    if (!localStorage.getItem('bs_cookie_consent')) {
        const banner = document.getElementById('cookie-banner');
        if (banner) {
            setTimeout(function () { banner.classList.add('show'); }, 1500);
            document.getElementById('cookie-accept').addEventListener('click', function () {
                localStorage.setItem('bs_cookie_consent', 'accepted');
                banner.classList.remove('show');
            });
            document.getElementById('cookie-decline').addEventListener('click', function () {
                localStorage.setItem('bs_cookie_consent', 'declined');
                banner.classList.remove('show');
            });
        }
    }

    /* ── Smooth scroll for anchor links ─────────────────── */
    document.querySelectorAll('a[href^="#"]').forEach(function (link) {
        link.addEventListener('click', function (e) {
            const target = document.querySelector(link.getAttribute('href'));
            if (target) {
                e.preventDefault();
                const offset = 80;
                const top = target.getBoundingClientRect().top + window.scrollY - offset;
                window.scrollTo({ top: top, behavior: 'smooth' });
            }
        });
    });

});
