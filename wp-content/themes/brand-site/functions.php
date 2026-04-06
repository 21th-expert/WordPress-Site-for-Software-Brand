<?php

add_action('after_setup_theme', function () {
    add_theme_support('title-tag');
    add_theme_support('custom-logo');
    add_theme_support('responsive-embeds');
    add_theme_support('align-wide');
    add_theme_support('wp-block-styles');
    add_theme_support('editor-styles');
    add_theme_support('html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ]);
    register_nav_menus([
        'primary' => __('Primary Navigation', 'brand-site'),
    ]);
});

add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style(
        'brand-site-style',
        get_stylesheet_uri(),
        [],
        wp_get_theme()->get('Version')
    );
});
