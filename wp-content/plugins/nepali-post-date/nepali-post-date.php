<?php
/*
Plugin Name: Nepali Post Date
Plugin URI: https://wordpress.org/plugins/nepali-post-date/
Description: Nepali Post date is a wordpress plugin that converts the English date format to nepal date format. Not only does it convert the date format but also the hours too.
Version: 5.1.1
Author: Padam Shankhadev
Author URI: https://www.padamshankhadev.com
*/

/* Prevent Direct access */
if ( !defined( 'DB_NAME' ) ) {
    header( 'HTTP/1.0 403 Forbidden' );
    die;
}

/* Define BaseName */
if ( !defined( 'NEPALIPOSTDATE_BASENAME' ) )
    define( 'NEPALIPOSTDATE_BASENAME', plugin_basename( __FILE__ ) );

/* Define plugin url */
if( !defined('NEPALIPOSTDATE_PLUGIN_URL' ))
    define('NEPALIPOSTDATE_PLUGIN_URL', plugin_dir_url(__FILE__));

/* Define plugin path */
if( !defined('NEPALIPOSTDATE_PLUGIN_DIR' ))
    define('NEPALIPOSTDATE_PLUGIN_DIR', plugin_dir_path(__FILE__));

/* Plugin version */
define('NEPALIPOSTDATE', '5.1.1');

/* Load Up the text domain */
function npdate_textdomain() {
    load_plugin_textdomain( 'npdate', false, basename( dirname( __FILE__ ) ) . '/languages' );
}

add_action( 'plugins_loaded', 'npdate_textdomain' );

/* Check if we're running compatible software */
if ( version_compare( PHP_VERSION, '5.2', '<' ) && version_compare( WP_VERSION, '3.7', '<' ) ) {
    if ( is_admin() ) {
        require_once ABSPATH . 'wp-admin/includes/plugin.php';
        deactivate_plugins( __FILE__ );
        wp_die( __( 'Nepali post date plugin requires WordPress 3.8 and PHP 5.3 or greater. The plugin has now disabled itself' ) );
    }
}


/* Let's load up our plugin */
function npd_frontend_init() {
    require_once( NEPALIPOSTDATE_PLUGIN_DIR . 'class.nepali.date.php' );
    require_once( NEPALIPOSTDATE_PLUGIN_DIR . 'class.nepali.date.front.php' );
    new Nepali_Post_Date_Frontend();
}

function npd_admin_init() {
    require_once( NEPALIPOSTDATE_PLUGIN_DIR . 'class.nepali.date.admin.php' );
    new Nepali_Post_Date_Admin();
}

if( is_admin() ) :

    add_action( 'plugins_loaded', 'npd_admin_init', 15 );

else :

    add_action( 'plugins_loaded', 'npd_frontend_init', 50 );

endif;

if( ! function_exists( 'get_nepali_post_date' )) {

    function get_nepali_post_date( $post_date ) {
        $f_date = new Nepali_Post_Date_Frontend();

        $default_opts = array(
            'active' => array( 'date' => true, 'time' => true ),
            'date_format' => 'd m y, l',
            'custom_date_format' => ''
        );

        $default_opts = apply_filters( 'npd_modify_default_opts', $default_opts );

        $opts = get_option( 'npd_opts', $default_opts );

        $post_date = ( !empty( $post_date ) ) ? strtotime( $post_date ) : time();

        if ( $opts['custom_date_format'] ) {
            $format = $opts['custom_date_format'];
        } else {
            $format = $opts['date_format'];
        }

        if ( $opts['active']['time'] ) {
            $converted_date = $f_date->get_converted_nepali_date( $post_date, $format, true );
        } else {
            $converted_date = $f_date->get_converted_nepali_date( $post_date, $format );
        }

        return $converted_date;
    }
}

if( ! function_exists( 'get_nepali_today_date' ) ) {

    function get_nepali_today_date() {
        $f_date = new Nepali_Post_Date_Frontend();

        $default_opts = array(
            'date_format' => 'd m y, l',
            'today_date_format' => ''
        );

        $default_opts = apply_filters( 'npd_modify_default_opts', $default_opts );

        $opts = get_option( 'npd_opts', $default_opts );

        if ( $opts['today_date_format'] ) {
            $format = $opts['today_date_format'];
        } else {
            $format = $opts['date_format'];
        }

        return $f_date->get_converted_nepali_date( time(), $format );
    }
}

if( ! function_exists( 'convert_into_nepali_number' ) ) {

    function convert_into_nepali_number( $str ) {
        $f_date = new Nepali_Post_Date_Frontend();

        return $f_date->convert_into_nepali_number( $str );
    }
}


