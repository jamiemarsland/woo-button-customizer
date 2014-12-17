<?php
/*
Plugin Name: Button Customizer
Plugin URI: http://see-ya-soon.com
Description: Plugin for customizing WooCommerce buttons
Version: 0.7
Author: Shramee
Author URI: http://shramee.com/
License: GPL version 2 or later - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
*/
require_once('inc/functions.php');
require_once('inc/actions.php');
function woo_bc_s_wp_admin_scripts() {
    wp_enqueue_script(
        'woo_bc_s-customizer-menu-script',
        plugins_url(). '/cx-button-customizer/js/customizr-menu.js',
        array( 'jquery'),
        '0.3.0',
        true
    );
    wp_enqueue_style('woo_bc_s-customizer-menu-script', plugins_url(). '/cx-button-customizer/css/customizr-menu.css');
}
add_action( 'admin_enqueue_scripts', 'woo_bc_s_wp_admin_scripts' );
//add_action( 'customize_preview_init', 'woo_bc_s_customizer_live_preview' );
?>