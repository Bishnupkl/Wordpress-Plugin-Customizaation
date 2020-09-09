<?php
defined('ABSPATH') or die('No Script kiddiess please');
/**
 * Plugin Name
 *
 * @package           PluginPackage
 * @author            Bishnu Pokhrel
 * @copyright         2019 Your Name or Company Name
 * @license           GPL-2.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:       Plugin Contact Form
 * Plugin URI:        https://github.com/Bishnupkl/Wordpress-Plugin-Customizaation
 * Description:       A simple contct form plugin
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Bishnu Pokhrel
 * Author URI:        https://github.com/Bishnupkl/
 * Text Domain:       plugin-slug
 * Domain Path:       /languages
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

//procedural way
//add_action('admin_menu', 'plugin_contact_form');
//if (!function_exists('plugin_contact_form')) {
//    function plugin_contact_form()
//    {
//        add_menu_page('Plugin Contact Form', 'P Contact Form', 'manage_options', 'plugin-contact-form', 'plugin_contact_page', 'dashicons-email');
//    }
//
//}
//
//if (!function_exists('plugin_contact_page')) {
//    function plugin_contact_page()
//    {
//        echo "This is plugin's setting page";
//    }
//}


//oop way

if(!class_exists('Plugin_Contact_Form')) {
    class Plugin_Contact_Form
    {
        function __construct()
        {
            $this->define_constants();
            add_action('admin_menu',array($this,'plugin_contact_form'));
            add_action('admin_enqueue_scripts',array($this, 'register_admin_assets',));
            add_action('admin_post_pw_settings_save_action',array($this,'save_settings_section'));
        }

        function define_constants()
        {
            defined('PWCF_PATH') or define('PWCF_PATH', plugin_dir_path(__FILE__));
            defined('PWCF_URL') or define('PWCF_URL', plugin_dir_url(__FILE__));
            defined('PWCF_VERSION') or define('PWCF_VERSION', '1.0.0');
        }

        function plugin_contact_form()
        {
            add_menu_page('Plugin Contact Form', 'P Contact Form', 'manage_options', 'plugin-contact-form', array($this, 'plugin_contact_page'), 'dashicons-email');
        }

        function plugin_contact_page()
        {
//            echo "THis is out plugin's setting page";
            include(PWCF_PATH . 'includes/views/backend/settings.php');
        }

        function register_admin_assets()
        {
            wp_enqueue_style( 'pwcf_backend_style',PWCF_URL.'assets/css/pwcf-backend.css',array(),PWCF_VERSION );
            wp_enqueue_script( 'pwcf_backend_script',PWCF_URL.'assets/js/pwcf-backend.js',array('jquery'),PWCF_VERSION );

        }

        function save_settings_section()
        {
            $name = $_POST['name_field_label'];
            $email = $_POST['email_field_label'];
            $message = $_POST['message_field_label'];
            $message = $_POST['_field_label'];
        }
    }

    new Plugin_Contact_Form();
}