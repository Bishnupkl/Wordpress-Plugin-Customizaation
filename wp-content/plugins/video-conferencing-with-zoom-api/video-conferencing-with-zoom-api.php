<?php
/**
 * @link              http://www.deepenbajracharya.com.np
 * @since             1.0.0
 * @package           Video Conferencing with Zoom API
 *
 * Plugin Name:       Video Conferencing with Zoom API
 * Plugin URI:        http://www.deepenbajracharya.com.np
 * Description:       Add, Handle Zoom meetings from WordPress Dashboard using API. Now integrated with Frontend as well.
 * Version:           3.1.3
 * Author:            Deepen Bajracharya
 * Author URI:        http://www.deepenbajracharya.com.np
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       video-conferencing-with-zoom-api
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'ZVC_PLUGIN_SLUG', 'video-conferencing-zoom' );
define( 'ZVC_PLUGIN_AUTHOR', 'https://deepenbajracharya.com.np' );
define( 'ZVC_PLUGIN_DIR_PATH', plugin_dir_path( __FILE__ ) );
define( 'ZVC_PLUGIN_DIR_URL', plugin_dir_url( __FILE__ ) );
define( 'ZVC_PLUGIN_ADMIN_ASSETS_URL', ZVC_PLUGIN_DIR_URL . 'assets/admin' );
define( 'ZVC_PLUGIN_PUBLIC_ASSETS_URL', ZVC_PLUGIN_DIR_URL . 'assets/public' );
define( 'ZVC_PLUGIN_VENDOR_ASSETS_URL', ZVC_PLUGIN_DIR_URL . 'assets/vendor' );
define( 'ZVC_PLUGIN_VIEWS_PATH', ZVC_PLUGIN_DIR_PATH . 'includes/views' );
define( 'ZVC_PLUGIN_INCLUDES_PATH', ZVC_PLUGIN_DIR_PATH . 'includes' );
define( 'ZVC_PLUGIN_IMAGES_PATH', ZVC_PLUGIN_DIR_URL . 'assets/images' );
define( 'ZVC_PLUGIN_LANGUAGE_PATH', trailingslashit( basename( ZVC_PLUGIN_DIR_PATH ) ) . 'languages/' );

// the main plugin class
if ( ! class_exists( 'Video_Conferencing_With_Zoom' ) ) {
	require_once ZVC_PLUGIN_INCLUDES_PATH . '/class-zvc-init.php';
}

add_action( 'plugins_loaded', array( 'Video_Conferencing_With_Zoom', 'instance' ), 99 );
register_deactivation_hook( __FILE__, array( 'Video_Conferencing_With_Zoom', 'deactivate' ) );
