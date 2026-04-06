<?php

// ── Theme setup ────────────────────────────────────────────
add_action('after_setup_theme', function () {
    add_theme_support('title-tag');
    add_theme_support('custom-logo');
    add_theme_support('responsive-embeds');
    add_theme_support('align-wide');
    add_theme_support('wp-block-styles');
    add_theme_support('editor-styles');
    add_theme_support('html5', ['search-form','comment-form','comment-list','gallery','caption','style','script']);
    register_nav_menus(['primary' => __('Primary Navigation', 'brand-site')]);
});

// ── Enqueue assets ─────────────────────────────────────────
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style(
        'brand-inter',
        'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap',
        [],
        null
    );
    wp_enqueue_style('brand-site', get_stylesheet_uri(), ['brand-inter'], '2.0.0');
    wp_enqueue_script('brand-site-js', get_template_directory_uri() . '/assets/main.js', [], '2.0.0', true);
});

// ── Performance: DNS prefetch & preconnect ─────────────────
add_action('wp_head', function () {
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
    echo '<link rel="dns-prefetch" href="https://www.google-analytics.com">' . "\n";
}, 1);

// ── SEO: meta description & Open Graph ────────────────────
add_action('wp_head', function () {
    $description = 'BrandSite — Smart software for modern businesses. Fast, secure, and fully responsive WordPress websites that convert visitors into leads.';
    $site_url    = get_site_url();
    $site_name   = 'BrandSite';
    echo '<meta name="description" content="' . esc_attr($description) . '">' . "\n";
    echo '<meta property="og:site_name" content="' . esc_attr($site_name) . '">' . "\n";
    echo '<meta property="og:type" content="website">' . "\n";
    echo '<meta property="og:url" content="' . esc_url($site_url) . '">' . "\n";
    echo '<meta property="og:title" content="' . esc_attr($site_name) . ' — Smart software for modern businesses">' . "\n";
    echo '<meta property="og:description" content="' . esc_attr($description) . '">' . "\n";
    echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
    echo '<meta name="twitter:title" content="' . esc_attr($site_name) . '">' . "\n";
    echo '<meta name="twitter:description" content="' . esc_attr($description) . '">' . "\n";
}, 5);

// ── Google Analytics 4 ────────────────────────────────────
// STEP: When you have your GA4 Measurement ID, replace the empty string below
// with your ID (format: G-XXXXXXXXXX) and set $ga4_enabled to true.
$ga4_id      = 'G-JJP38XW8MZ';       // e.g. 'G-ABC1234567'
$ga4_enabled = false;    // change to true after adding your ID above

if ($ga4_enabled && ! empty($ga4_id)) {
    add_action('wp_head', function () use ($ga4_id) {
        echo "<!-- Google Analytics 4 -->\n";
        echo '<script async src="https://www.googletagmanager.com/gtag/js?id=' . esc_attr($ga4_id) . '"></script>' . "\n";
        echo "<script>\n";
        echo "  window.dataLayer = window.dataLayer || [];\n";
        echo "  function gtag(){dataLayer.push(arguments);}\n";
        echo "  gtag('js', new Date());\n";
        echo "  gtag('config', '" . esc_js($ga4_id) . "', { anonymize_ip: true });\n";
        echo "</script>\n";
    }, 10);
}

// ── Security: remove WordPress version fingerprint ────────
remove_action('wp_head', 'wp_generator');
add_filter('the_generator', '__return_empty_string');

// ── Security: disable XML-RPC ─────────────────────────────
add_filter('xmlrpc_enabled', '__return_false');

// ── Performance: remove unused head bloat ─────────────────
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_shortlink_wp_head');

// ── Block pattern registration ────────────────────────────
add_action('init', function () {
    register_block_pattern_category('brand-site', ['label' => __('Brand Site', 'brand-site')]);
    register_block_pattern('brand-site/contact-form', [
        'title'      => __('Contact Form Section', 'brand-site'),
        'content'    => file_get_contents(get_template_directory() . '/block-patterns/contact-form.php'),
        'categories' => ['brand-site'],
    ]);
});
