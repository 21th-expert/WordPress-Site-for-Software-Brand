<?php

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

// Enqueue Inter font + theme stylesheet
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

// Register block pattern category
add_action('init', function () {
    register_block_pattern_category('brand-site', ['label' => __('Brand Site', 'brand-site')]);
    register_block_pattern('brand-site/contact-form', [
        'title'      => __('Contact Form Section', 'brand-site'),
        'content'    => file_get_contents(get_template_directory() . '/block-patterns/contact-form.php'),
        'categories' => ['brand-site'],
    ]);
});
