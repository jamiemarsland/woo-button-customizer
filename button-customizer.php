<?php
/*
Plugin Name: Woo Button Customizer
Plugin URI: http://www.pootlepress.com
Description: Plugin for customizing WooThemes Shortcode buttons
Version: 0.7
Author: PootlePress
Author URI: http://www.pootlepress.com/
License: GPL version 2 or later - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
*/
require_once('inc/functions.php');
require_once('inc/actions.php');
function woo_bc_s_wp_admin_scripts() {
    wp_enqueue_script(
        'woo_bc_s-customizer-menu-script',
        plugins_url(). '/woo-button-customizer/js/customizr-menu.js',
        array( 'jquery'),
        '0.3.0',
        true
    );
    wp_enqueue_style('woo_bc_s-customizer-menu-script', plugins_url(). '/cx-button-customizer/css/customizr-menu.css');
}
add_action( 'admin_enqueue_scripts', 'woo_bc_s_wp_admin_scripts' );
//add_action( 'customize_preview_init', 'woo_bc_s_customizer_live_preview' );
?>
