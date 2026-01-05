<?php

/**
 * Plugin Name: Funfact / Trusted Counters Widget
 * Description: Elementor widget for funfact / trusted counters with animation.
 * Version: 1.0
 * Author: Your Name
 */

if (! defined('ABSPATH')) exit;

define('FUNFACT_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('FUNFACT_PLUGIN_URL', plugin_dir_url(__FILE__));

/**
 * Register scripts & styles
 */
add_action('wp_enqueue_scripts', function () {

    wp_register_script(
        'funfact-counter',
        FUNFACT_PLUGIN_URL . 'assets/js/funfact-counter.js',
        [],
        '1.0',
        true
    );

    wp_register_style(
        'funfact-style',
        FUNFACT_PLUGIN_URL . 'assets/css/funfact-style.css',
        [],
        '1.0'
    );
});

/**
 * Register Elementor Widget
 */
add_action('elementor/widgets/register', function ($widgets_manager) {

    require_once FUNFACT_PLUGIN_DIR . 'includes/class-funfact-widget.php';

    $widgets_manager->register(new \Funfact_Widget());
});