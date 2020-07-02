<?php
/*
 * Plugin Name: Hotel Booking & Astra Theme Integration 
 * Description: Adds some basic styles for MotoPress Hotel Booking plugin in Astra theme.
 * Version: 1.0.0
 * Author: MotoPress
 * Author URI: https://motopress.com/
 * License: GPLv2 or later
 * Text Domain: mphb-astra 
 */

if (!defined('MPHB_ASTRA_VERSION')) {
    define('MPHB_ASTRA_VERSION', '1.0.0');
}

add_action('wp_enqueue_scripts', 'mphb_astra_enqueue_scripts');

function mphb_astra_enqueue_scripts()
{
    if (!function_exists('MPHB')) {
        return;
    }

    wp_enqueue_style('mphb-astra', plugin_dir_url(__FILE__) . 'assets/style.css', [], MPHB_ASTRA_VERSION);
}

function mphb_astra_filter_reviews_template()
{
    return plugin_dir_path(__FILE__) . 'templates/reviews.php';
}

add_action('template_redirect', 'mphb_astra_add_template_filters');

function mphb_astra_filter_templates($template, $slug, $atts)
{
    if ('shortcodes/rooms/room-content' == $slug) {
        $template = plugin_dir_path(__FILE__) . 'templates/rooms/room-content.php';
    }

    return $template;
}

function mphb_astra_add_template_filters()
{
    if (!function_exists('MPHB')) {
        return;
    }

    add_filter('mphb_get_template_part', 'mphb_astra_filter_templates', 10, 3);

    if (function_exists('MPHBR')) {
        add_filter('mphbr_reviews_template', 'mphb_astra_filter_reviews_template');
    }
}

