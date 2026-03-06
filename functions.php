<?php

// Get the current theme object
$theme = wp_get_theme();

// Define a constant with the theme version
if (!defined('THEME_VERSION')) {
    define('THEME_VERSION', $theme->get('Version'));
}

add_action('after_setup_theme', function () {
    load_theme_textdomain('ktu-licejus', get_template_directory() . '/languages');

    // Theme supports
    add_theme_support('title-tag');
    add_theme_support('widgets');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['gallery', 'caption', 'style', 'script']);
    add_theme_support('customize-selective-refresh-widgets');

    add_theme_support(
        'html5',
        [
            'search-form',
            'gallery',
            'caption',
            'style',
            'script',
        ]
    );

    add_theme_support(
        'custom-logo',
        [
            'height'      => 96,
            'width'       => 96,
            'flex-width'  => true,
            'flex-height' => true,
        ]
    );

    register_nav_menus([
        'top-menu' => esc_html__('Top menu', 'ktu-licejus'),
    ]);
});

add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('main-style', get_template_directory_uri() . '/assets/css/main.min.css', [], THEME_VERSION);

    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css', [], '6.5.1');
});

require get_template_directory() . '/customizer.php';
