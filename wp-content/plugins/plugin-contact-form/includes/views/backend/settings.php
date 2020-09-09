<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!!' );
?>
<div class="wrap">
    <div class="pwcf-header"><h2>Plugin Contact Form </h2></div>
    <div class="pwcf-settings-wrap">
        <form method="post" action="<?php echo admin_url('admin-post.php')?>">
            <input type="hidden" name="action" value="pw_settings_save_action"/>

            <h3>Form Settings</h3>
            <div class="pwcf-field-wrap">
                <label>Name Field Label</label>
                <div class="pwcf-field">
                    <input type="text" name="name_field_label"/>
                </div>
            </div>
            <div class="pwcf-field-wrap">
                <label>Email Field Label</label>
                <div class="pwcf-field">
                    <input type="text" name="email_field_label"/>
                </div>
            </div>
            <div class="pwcf-field-wrap">
                <label>Message Field Label</label>
                <div class="pwcf-field">
                    <input type="text" name="message_field_label"/>
                </div>
            </div>
            <div class="pwcf-field-wrap">
                <label>Submit Button Label</label>
                <div class="pwcf-field">
                    <input type="text" name="submit_button_label"/>
                </div>
            </div>
            <h3>Other Settings</h3>
            <div class="pwcf-field-wrap">
                <label>Admin Email</label>
                <div class="pwcf-field">
                    <input type="text" name="admin_email"/>
                </div>
            </div>
            <div class="pwcf-field-wrap">
                <label></label>
                <div class="pwcf-field">
                    <input type="submit" class="button-primary" value="Save Settings"/>
                </div>
            </div>
        </form>
    </div>
</div>