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

if (!class_exists('Plugin_Contact_Form')) {
    class Plugin_Contact_Form
    {
        function __construct()
        {
            $this->define_constants();
            add_action('admin_menu', array($this, 'plugin_contact_form'));
            add_action('admin_enqueue_scripts', array($this, 'register_admin_assets',));
            add_action('admin_post_pw_settings_save_action', array($this, 'save_settings_section'));
            add_shortcode('plugin_contact_form', array($this, 'generate_shortcode_html'));
            add_action('template_redirect', array($this, 'process_form'));
            add_action('wp_enqueue_scripts', array($this, 'register_frontend_assets'));
            add_action('wp_ajax_pwcf_ajax_action', array($this, 'process_form_ajax'));
            add_action('wp_ajax_nopriv_pwcf_ajax_action', array($this, 'process_form_ajax'));


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
            wp_enqueue_style('pwcf_backend_style', PWCF_URL . 'assets/css/pwcf-backend.css', array(), PWCF_VERSION);
            wp_enqueue_script('pwcf_backend_script', PWCF_URL . 'assets/js/pwcf-backend.js', array('jquery'), PWCF_VERSION);

        }

        function save_settings_section()
        {
            if (!empty($_POST['pwcf_settings_nonce_field']) && wp_verify_nonce($_POST['pwcf_settings_nonce_field'], 'pwcf_settings_nonce')) {

                $name = sanitize_text_field($_POST['name_field_label']);
                $email = sanitize_text_field($_POST['email_field_label']);
                $message = sanitize_text_field($_POST['message_field_label']);
                $submit = sanitize_text_field($_POST['submit_button_label']);
                $admin_email = sanitize_email($_POST['admin_email']);

                $pwcf_settings = array(
                    'name' => $name,
                    'email' => $email,
                    'message' => $message,
                    'submit_button_label' => $submit,
                    'admin_email' => $admin_email,
                );


                update_option('pwcf_settings', $pwcf_settings);
                wp_redirect(admin_url('admin.php?page=plugin-contact-form&message=1'));
                exit;
            }
        }

        function print_array($array)
        {
            if (isset($_GET['debug'])) {
                echo "<pre>";
                print_r($array);
                echo "</pre>";
            }
        }

        function generate_shortcode_html()
        {
            ob_start();
            include(PWCF_PATH . 'includes/views/frontend/shortcode.php');
            $form_html = ob_get_contents();
            ob_end_clean();
            return $form_html;
        }


        function process_form()
        {
            if (!empty($_POST['pwcf_form_nonce_field']) && wp_verify_nonce($_POST['pwcf_form_nonce_field'], 'pwcf_form_nonce')) {
                session_start();
                $pwcf_settings = get_option('pwcf_settings');
                $name_field = sanitize_text_field($_POST['name_field']);
                $email_field = sanitize_text_field($_POST['email_field']);
                $message_field = sanitize_text_field($_POST['message']);
                $email_html = 'Hello there, <br/>'
                    . '<br/>'
                    . 'Your have received an email from your site. Details below: <br/>'
                    . '<br/>'
                    . 'Name: ' . $name_field . '<br/>'
                    . 'Email: ' . $email_field . '<br/>'
                    . 'Message: ' . $message_field . '<br/>'
                    . '<br/>'
                    . 'Thank you';
                $headers[] = 'Content-Type: text/html; charset=UTF-8';
                $headers[] = 'No Reply<noreply@localhost.com>';
                $subject = 'New contact email received';
                $admin_email = (!empty($pwcf_settings['admin_email'])) ? $pwcf_settings['admin_email'] : get_option('admin_email');
                $mail_check = wp_mail($admin_email, $subject, $email_html, $headers);
                if ($mail_check) {
                    $message = 'Email sent successfully.';
                } else {
                    $message = 'Email couldn\'t be sent.';
                }
                $_SESSION['pwcf_message'] = $message;
            }
        }

        function register_frontend_assets()
        {
            wp_enqueue_style('pwcf-frontend-style', PWCF_URL . 'assets/css/pwcf-frontend.css', array(), PWCF_VERSION);
            wp_enqueue_script('pwcf-frontend-script', PWCF_URL . 'assets/js/pwcf-frontend.js', array('jquery'), PWCF_VERSION);
        }

        function process_form_ajax()
        {
            die('reached here');

            if (!empty($_POST['_wpnonce']) && wp_verify_nonce($_POST['_wpnonce'], 'pwcf_ajax_nonce')) {
                $name_field = sanitize_text_field($_POST['name_field']);
                $email_field = sanitize_text_field($_POST['email_field']);
                $message_field = sanitize_text_field($_POST['message_field']);
                $email_html = 'Hello there, <br/>'
                    . '<br/>'
                    . 'Your have received an email from your site. Details below: <br/>'
                    . '<br/>'
                    . 'Name: ' . $name_field . '<br/>'
                    . 'Email: ' . $email_field . '<br/>'
                    . 'Message: ' . $message_field . '<br/>'
                    . '<br/>'
                    . 'Thank you';
                $headers[] = 'Content-Type: text/html; charset=UTF-8';
                $headers[] = 'No Reply<noreply@localhost.com>';
                $subject = 'New contact email received';
                $admin_email = (!empty($pwcf_settings['admin_email'])) ? $pwcf_settings['admin_email'] : get_option('admin_email');
                $mail_check = wp_mail($admin_email, $subject, $email_html, $headers);
                if ($mail_check) {
                    $status = 200;
                    $message = esc_html__('Email sent successfully.', 'pw-contact-form');
                } else {
                    $status = 403;
                    $message = esc_html__('Email couldn\'t be sent.', 'pw-contact-form');
                }
                $response['status'] = $status;
                $response['message'] = $message;
                die(json_encode($response));
            } else {
                die('No script kiddies please!!');
            }
        }
    }


    new Plugin_Contact_Form();
}