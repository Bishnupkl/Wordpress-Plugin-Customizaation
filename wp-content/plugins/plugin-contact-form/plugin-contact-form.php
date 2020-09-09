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
            add_action('admin_menu',array($this,'plugin_contact_form'));
        }

        function plugin_contact_form()
        {
            add_menu_page('Plugin Contact Form', 'P Contact Form', 'manage_options', 'plugin-contact-form', array($this,plugin_contact_page), 'dashicons-email')
        }

        function plugin_contact_page()
        {
            echo "THis is out plugin's setting page";
        }
    }

    new Plugin_Contact_Form();
}