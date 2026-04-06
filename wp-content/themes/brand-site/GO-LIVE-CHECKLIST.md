# BrandSite — Go-Live Checklist

## Status: Local XAMPP → Ready to go live

---

## 1. Domain & Hosting (TODO when ready)

- [ ] Buy domain at https://www.namecheap.com or https://www.home.pl
      Recommended: brandsite.pl (~50 PLN/yr) or brandsite.com (~60 PLN/yr)

- [ ] Pick a host:
      - Budget:     home.pl shared hosting (~20 PLN/month)
      - Recommended: Hetzner VPS CX22 (€4/month) — faster, full control
      - Easy:       Siteground or Bluehost (one-click WordPress)

- [ ] Upload site files via FTP or cPanel File Manager to public_html/

- [ ] Export local database:
      http://localhost/phpmyadmin → software_brand_db → Export → SQL file

- [ ] Import database on live host via phpMyAdmin

- [ ] Update wp-config.php with live DB credentials

- [ ] Update Site URL in wp-admin → Settings → General:
      Siteurl: https://yourdomain.com
      Home:    https://yourdomain.com

      OR run in MySQL:
      UPDATE wp_options SET option_value='https://yourdomain.com'
      WHERE option_name IN ('siteurl','home');

---

## 2. SSL Certificate (free — do after domain is live)

Option A — Cloudflare (easiest, recommended):
  1. Sign up free at https://cloudflare.com
  2. Add your domain → copy the 2 nameservers it gives you
  3. Go to your domain registrar → change nameservers to Cloudflare's
  4. In Cloudflare: SSL/TLS → set to "Full (strict)"
  5. Done — HTTPS active within minutes, no server config needed

Option B — Let's Encrypt (if on VPS):
  Run: sudo certbot --apache -d yourdomain.com

---

## 3. PageSpeed Insights (do after going live)

URL: https://pagespeed.web.dev

Target scores:
  - Performance:   90+
  - Accessibility: 95+
  - Best Practices: 95+
  - SEO:           95+

Quick wins already done in this theme:
  [x] Preconnect to Google Fonts
  [x] DNS prefetch for Analytics
  [x] Deferred JS loading
  [x] Removed WP head bloat (generator, wlwmanifest, rsd)
  [x] Lightweight CSS (no framework)

Plugins to install for extra speed:
  - WP Super Cache (free) — page caching
  - Smush (free)          — image compression
  - Autoptimize (free)    — CSS/JS minification

---

## 4. Mobile & Nav Testing (do on real phone)

Pages to test:
  [ ] / (homepage) — hero, nav, contact form
  [ ] /product/    — product items, SVG illustrations
  [ ] /pricing/    — 3 pricing cards
  [ ] /resources/  — resource cards

Things to check:
  [ ] Hamburger menu opens and closes
  [ ] All nav links scroll/navigate correctly
  [ ] Contact form fields are easy to tap
  [ ] Buttons are large enough (min 44px tap target)
  [ ] Text is readable without zooming
  [ ] Images don't overflow on small screens

---

## 5. Google Analytics 4 (ready to activate)

Step 1 — Create GA4 account:
  1. Go to https://analytics.google.com
  2. Click "Start measuring"
  3. Account name: BrandSite
  4. Property name: BrandSite Website
  5. Select: Web → enter your domain
  6. Copy your Measurement ID (format: G-XXXXXXXXXX)

Step 2 — Add to theme (already wired up in functions.php):
  Open: wp-content/themes/brand-site/functions.php
  Find these two lines near the top:
    $ga4_id      = '';
    $ga4_enabled = false;

  Change to:
    $ga4_id      = 'G-XXXXXXXXXX';  ← paste your real ID here
    $ga4_enabled = true;

Step 3 — Verify:
  In GA4 → Realtime report → open your site → you should see 1 active user

---

## 6. Essential Plugins to Install (wp-admin → Plugins → Add New)

  [ ] WP Super Cache     — performance / page caching
  [ ] Yoast SEO          — SEO meta, XML sitemap, breadcrumbs
  [ ] WPForms Lite       — real working contact form with email delivery
  [ ] WP Mail SMTP       — ensures contact form emails actually arrive
  [ ] Wordfence Security — firewall + malware scanning
  [ ] UpdraftPlus        — automated daily backups to Google Drive

---

## 7. Final Pre-Launch Checks

  [ ] Replace all placeholder content (done ✓)
  [ ] Real logo uploaded (SVG logo done ✓)
  [ ] Contact info updated (done ✓)
  [ ] Privacy Policy page published
  [ ] 404 page template exists (done ✓)
  [ ] Favicon set (wp-admin → Appearance → Customize → Site Identity)
  [ ] Test contact form sends email
  [ ] Check all pages return 200 (not 404)
  [ ] Permalinks set to Post name (wp-admin → Settings → Permalinks)
  [ ] Front page set to static page (wp-admin → Settings → Reading)
