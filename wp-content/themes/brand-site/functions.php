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
    wp_enqueue_style('brand-inter', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap', [], null);
    wp_enqueue_style('brand-site', get_stylesheet_uri(), ['brand-inter'], '2.1.0');
    wp_enqueue_script('brand-site-js', get_template_directory_uri() . '/assets/main.js', [], '2.1.0', true);
    wp_localize_script('brand-site-js', 'brandsiteVars', [
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('brandsite_contact_nonce'),
    ]);
});

// ── AJAX contact form handler ──────────────────────────────
add_action('wp_ajax_brandsite_contact',        'brandsite_handle_contact');
add_action('wp_ajax_nopriv_brandsite_contact', 'brandsite_handle_contact');
function brandsite_handle_contact() {
    if (! check_ajax_referer('brandsite_contact_nonce', 'nonce', false)) {
        wp_send_json_error('Invalid nonce');
    }
    $fname    = sanitize_text_field($_POST['fname']    ?? '');
    $lname    = sanitize_text_field($_POST['lname']    ?? '');
    $email    = sanitize_email($_POST['email']         ?? '');
    $company  = sanitize_text_field($_POST['company']  ?? '');
    $interest = sanitize_text_field($_POST['interest'] ?? '');
    $message  = sanitize_textarea_field($_POST['message'] ?? '');

    if (empty($fname) || empty($email) || empty($message) || ! is_email($email)) {
        wp_send_json_error('Missing or invalid fields');
    }

    $to      = 'robinmichal03@gmail.com';
    $subject = 'New contact from BrandSite: ' . $fname . ' ' . $lname;
    $body    = "Name: {$fname} {$lname}\n";
    $body   .= "Email: {$email}\n";
    $body   .= "Company: {$company}\n";
    $body   .= "Interest: {$interest}\n\n";
    $body   .= "Message:\n{$message}";
    $headers = ['Content-Type: text/plain; charset=UTF-8', 'Reply-To: ' . $email];

    $sent = wp_mail($to, $subject, $body, $headers);
    if ($sent) {
        wp_send_json_success('Message sent');
    } else {
        wp_send_json_error('Mail failed');
    }
}

// ── Performance: DNS prefetch & preconnect ─────────────────
add_action('wp_head', function () {
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
    echo '<link rel="dns-prefetch" href="https://www.google-analytics.com">' . "\n";
}, 1);

// ── Favicon ────────────────────────────────────────────────
add_action('wp_head', function () {
    $favicon = get_template_directory_uri() . '/assets/favicon.svg';
    echo '<link rel="icon" type="image/svg+xml" href="' . esc_url($favicon) . '">' . "\n";
    echo '<link rel="shortcut icon" href="' . esc_url($favicon) . '">' . "\n";
}, 2);

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
// Replace empty string with your G-XXXXXXXXXX ID and set $ga4_enabled = true
$ga4_id      = 'G-JJP38XW8MZ';
$ga4_enabled = false;

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

// ── Security ───────────────────────────────────────────────
remove_action('wp_head', 'wp_generator');
add_filter('the_generator', '__return_empty_string');
add_filter('xmlrpc_enabled', '__return_false');
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
