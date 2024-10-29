<?php
/**
 * Plugin Name: Basic Scroll to Top
 * Plugin URI: 
 * Description: Back to top screen on the click on the button.
 * Version: 1.0.0
 * Author: Arpit Patel
 * Author URI: https://wordpress.org/support/users/arpit-patel/
 * Text Domain: basic-scroll-top
 * Domain Path: languages
 * 
 * @package sigma scrolltop
 * @category Core
 * @author arpitpatel
 */
/**
 * Basic plugin definitions 
 * 
 * @package sigma scrolltop
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

global $wpdb;

/**
 * Basic Plugin Definitions 
 * 
 * @package sigma scroll top
 * @since 1.0.0
 */
if( !defined( 'BASIC_SCROLLTOP_VERSION' ) ) {
	define( 'BASIC_SCROLLTOP_VERSION', '1.0.0' ); //version of plugin
}
if( !defined( 'BASIC_SCROLLTOP_DIR' ) ) {
	define( 'BASIC_SCROLLTOP_DIR', dirname( __FILE__ ) ); // plugin dir add like BASIC_SCROLLTOP_DIR . '/templates/';
}
if( !defined( 'BASIC_SCROLLTOP_ADMIN' ) ) {
	define( 'BASIC_SCROLLTOP_ADMIN', BASIC_SCROLLTOP_DIR . '/admin' ); // plugin admin dir
}
if( !defined( 'BASIC_SCROLLTOP_URL' ) ) {
	define( 'BASIC_SCROLLTOP_URL', plugin_dir_url( __FILE__ ) ); // plugin url
}
if( !defined( 'BASIC_SCROLLTOP_IMG_URL' ) ) {
	define( 'BASIC_SCROLLTOP_IMG_URL', BASIC_SCROLLTOP_URL . 'images' ); // plugin image url
}
if( !defined( 'BASIC_SCROLLTOP_TEXT_DOMAIN' ) ) {
	define( 'BASIC_SCROLLTOP_TEXT_DOMAIN', 'basic-scroll-top' ); // text domain for doing language translation
}
//metabox prefix
if( !defined( 'BASIC_SCROLLTOP_META_PREFIX' )) {
	define( 'BASIC_SCROLLTOP_META_PREFIX', '_sigma_scroll_top' );
}
if( !defined( 'BASIC_SCROLLTOP_PLUGIN_BASENAME' ) ) {
	define( 'BASIC_SCROLLTOP_PLUGIN_BASENAME', basename( BASIC_SCROLLTOP_DIR ) ); //Plugin base name
}
/**
 * Load Text Domain
 * 
 * This gets the plugin ready for translation.
 * 
 * @package sigma scroll top
 * @since 1.0.0
 */
function basic_scroll_top_load_textdomain() {
	
 // Set filter for plugin's languages directory
	$sigma_scroll_top_lang_dir	= dirname( plugin_basename( __FILE__ ) ) . '/languages/';
	$sigma_scroll_top_lang_dir	= apply_filters( 'sigma_scroll_top_languages_directory', $sigma_scroll_top_lang_dir );
	
	// Traditional WordPress plugin locale filter
	$locale	= apply_filters( 'plugin_locale',  get_locale(), 'basic-scroll-top' );
	$mofile	= sprintf( '%1$s-%2$s.mo', 'basic-scroll-top', $locale );
	
	// Setup paths to current locale file
	$mofile_local	= $sigma_scroll_top_lang_dir . $mofile;
	$mofile_global	= WP_LANG_DIR . '/' . BASIC_SCROLLTOP_PLUGIN_BASENAME . '/' . $mofile;
	
	if ( file_exists( $mofile_global ) ) { // Look in global /wp-content/languages/wp-ajax folder
		load_textdomain( 'basic-scroll-top', $mofile_global );
	} elseif ( file_exists( $mofile_local ) ) { // Look in local /wp-content/plugins/wp-ajax/languages/ folder
		load_textdomain( 'basic-scroll-top', $mofile_local );
	} else { // Load the default language files
		load_plugin_textdomain( 'basic-scroll-top', false, $sigma_scroll_top_lang_dir );
	}
  
}

/**
 * Activation hook
 * 
 * Register plugin activation hook.
 * 
 * @package sigma scroll top
 * @since 1.0.0
 */
register_activation_hook( __FILE__, 'basic_scroll_top_install' );

/**
 * Deactivation hook
 *
 * Register plugin deactivation hook.
 * 
 * @package sigma scroll top
 * @since 1.0.0
 */
register_deactivation_hook( __FILE__, 'basic_scroll_top_uninstall' );

/**
 * Plugin Setup Activation hook call back 
 *
 * Initial setup of the plugin setting default options 
 * and database tables creations.
 * 
 * @package sigma scroll top
 * @since 1.0.0
 */
function basic_scroll_top_install() {
	
	global $wpdb;
}

/**
 * Plugin Setup (On Deactivation)
 *
 * Does the drop tables in the database and
 * delete  plugin options.
 *
 * @package sigma scroll top
 * @since 1.0.0
 */
function basic_scroll_top_uninstall() {
	
	global $wpdb;
}

/**
 * Load Plugin
 * 
 * Handles to load plugin after
 * dependent plugin is loaded
 * successfully
 * 
 * @package sigma scroll top
 * @since 1.0.0
 */
function basic_scroll_top_plugin_loaded() {
 
	// load first plugin text domain
	basic_scroll_top_load_textdomain();
}

//add action to load plugin
add_action( 'plugins_loaded', 'basic_scroll_top_plugin_loaded' );

include( BASIC_SCROLLTOP_ADMIN . '/basic-scroll-top-setting.php');
include( BASIC_SCROLLTOP_DIR . '/public/basic-scroll-top-front.php');

add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'add_action_links' );

function add_action_links ( $links ) {
 $mylinks = array(
 '<a href="' . admin_url( 'options-general.php?page=basicscrolltop' ) . '">Settings</a>',
 );
return array_merge( $links, $mylinks );
}
?>