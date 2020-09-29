<?php
/**
 *Plugin Name:Idea Pro Example Plugin
 * Description:This is just an example plugin
 **/

//adding short code
function ideapro_example_function()
{
    $information = "This is a very basic plugin";
    $information .= "<div>This is a div section</div>";
    $information .= "<p>This is a block section of paragraph</p>";
    return $information;
}

add_shortcode('example', 'ideapro_display_footer_scripts');

//menu adding
function ideapro_admin_menu_option()
{
    add_menu_page('Header & Footer Scripts', 'Site Scripts', 'manage_options', 'ideapro-admin-menu', 'ideapro_scripts_page', '', 200);
}

add_action('admin_menu', 'ideapro_admin_menu_option');

function ideapro_scripts_page()
{
    if (array_key_exists('submit_script_updates', $_POST)) {
        update_option('ideapro_header_scripts', $_POST['header_scripts']);
        update_option('ideapro_footer_scripts', $_POST['footer_scripts']);
        ?>
        <div id="setting-error-settings-updated" class="updated-settings-error notice is-dismissible">
            <strong>
                Settings have been saved
            </strong>
        </div>
        <?php

    }
    $header_scripts = get_option('ideapro_header_scripts', 'none');
    $footer_scripts = get_option('ideapro_footer_scripts', 'none');

    ?>
    <div class="wrap">
        <h2>Update scripts</h2>
        <form action="" method="post">
            <label for="Header">Header Scripts</label>
            <textarea name="header_scripts" class="large-text" id=""><?php print $header_scripts; ?></textarea>
            <label for="footer">Footer Scripts</label>
            <textarea name="footer_scripts" class="large-text" id=""><?php print $footer_scripts; ?></textarea>
            <input type="submit" name="submit_script_updates" CLASS="button button-primary" value="UPDATE SCRIPTS">
        </form>
    </div>
    <?php
}

function ideapro_display_header_scripts()
{
    $header_scripts = get_option('ideapro_header_scripts', 'none');
    print  $header_scripts;

}

add_action('wp-head', 'ideapro_display_header_scripts');

function ideapro_display_footer_scripts()
{
    $footer_scripts = get_option('ideapro_footer_scripts', 'none');
    $header_scripts = get_option('ideapro_header_scripts', 'none');
    print  $header_scripts; ?><br/><?php
    print  $footer_scripts;
}

add_action('wp-foot', 'ideapro_display_footer_scripts');



/*Part 3 of plugin tutorial*/
function ideapro_form()
{
    /**content variable**/
    $content = '';
    $content .= '<form method="post" action="http://localhost/wc/thank-you/">';

    $content .= '<input type="text" name="full_name" placeholder="Enter Your Full Name">';
    $content .= '<br/>';

    $content .= '<input type="text" name="email" placeholder="Enter Your Email Address">';
    $content .= '<br/>';

    $content .= '<input type="text" name="phone_number" placeholder="Enter Your Phone Number">';
    $content .= '<br/>';

    $content .= '<textarea name="comments" placeholder="Give us your comments"></textarea>';
    $content .= '<br/>';

    $content .= '<input type="submit" name="ideapro_form_submit" value="SUBMIT YOUR INFORMATION">';
    $content .= '</form>';
    return $content;
}

add_shortcode('idea_ro_contact_form', 'ideapro_form');

function set_html_content_type()
{
    return 'text/html';
}

function ideapro_form_capture()
{

    global $post,$wpdb;
//    global ;
    if (array_key_exists('ideapro_form_submit', $_POST)) {
        $to = 'bishnup212@gmail.com';

        $subject = ' Idea pro example Site Form Submission';
        $body = '';
        $body .= 'Name: ' . $_POST['full_name'] . " <br/>";
        $body .= 'Email:' . $_POST['email'] . "<br>";
        $body .= 'Phone:' . $_POST['phone'] . "<br>";
        $body .= 'Comments:' . $_POST['comments'] . "<br>";
        add_filter('wp_mail_content_type', 'set_html_content_type');
        wp_mail($to, $subject, $body);
        remove_filter('wp_mail_content_type', 'set_html_content_type');

       /* Insert the information into comment */
      /*  $time = current_time('mysql');
        $data = array(
            'comment_post_ID' => $post->ID,
            'comment_content' => $body,
            'comment_author_IP' => $_SERVER['REMOTE_ADDR'],
            'comment_date' => $time,
            'comment_approved' => 1,
        );
        wp_insert_comment($data); */

      /* Add the submission to the database using the table we created*/

        $insertData = $wpdb->get_results("INSERT INTO ".$wpdb->prefix."form_submission (data) VALUES('".$body."') ");

    }
}

add_action('wp_head', 'ideapro_form_capture');

?>

