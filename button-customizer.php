<?php
/*
Plugin Name: Button Customizer
Plugin URI: http://
Description: Plugin for customizing WooCommerce Plugins
Version: 0.7
Author: Shramee
Author URI: http://shramee.com/
License: GPL version 2 or later - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
*/
require_once('inc/functions.php');
require_once('inc/actions.php');
function shramee_wp_admin_scripts() {
    wp_enqueue_script(
        'shramee-customizer-menu-script',
        plugins_url(). '/cx-button-customizer/js/customizr-menu.js',
        array( 'jquery'),
        '0.3.0',
        true
    );
    wp_enqueue_style('shramee-customizer-menu-script', plugins_url(). '/cx-button-customizer/css/customizr-menu.css');
}
add_action( 'admin_enqueue_scripts', 'shramee_wp_admin_scripts' );
/*
function shramee_customizer_live_preview() {
    wp_enqueue_script(
        'tcx-theme-customizer',
        plugins_url(). '/cx-button-customizer/js/customizr-menu.js',
        array( 'jquery', 'customize-preview' ),
        '0.3.0',
        true
    );
 
}
add_action( 'customize_preview_init', 'shramee_customizer_live_preview' );
*/
?>