<?php
/**
 *Plugin Name:Idea Pro Example Plugin
 * Description:This is just an example plugin
 **/

function ideapro_example_function()
{
    $information = "This is a very basic plugin";
    $information.="<div>This is a div section</div>";
    $information.="<p>This is a block section of paragraph</p>";
    return $information;
}

add_shortcode('example', 'ideapro_example_function');
function ideapro_admin_menu_option()
{
    add_menu_page('Header & Footer Scripts', 'Site Scripts', 'manage_options', 'ideapro-admin-menu', 'ideapro_scripts_page', '', 200);

}

add_action('admin_menu', 'ideapro_admin_menu_option');

function ideapro_scripts_page()
{
    if (array_key_exists('submit_script_updates',$_POST)) {
        update_option('ideapro_header_scripts',$_POST['header_scripts']);
        update_option('ideapro_footer_scripts',$_POST['footer_scripts']);
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
    $footer_scripts=get_option('ideapro_footer_scripts','none');
    print  $footer_scripts;
}
add_action('wp-foot', 'ideapro_display_footer_scripts');

?>

