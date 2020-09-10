<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!!' );
$pwcf_settings = get_option( 'pwcf_settings' );
if ( !empty( $pwcf_settings ) ) {
    $this->print_array( $pwcf_settings );
}
?>
<div class="wrap">
    <div class="pwcf-header"><h2>PW Contact Form Settings</h2></div>
    <?php
    if ( !empty( $_GET['message'] ) && $_GET['message'] == 1 ) {
        ?>
        <div class="notice notice-info is-dismissible inline">
            <p>
                Settings saved successfully.
            </p>
        </div>
        <?php
    }
    ?>
    <div class="pwcf-settings-wrap">
        <form method="post" action="<?php echo admin_url( 'admin-post.php' ); ?>">

            <?php wp_nonce_field('pwcf_settings_nonce','pwcf_settings_nonce_field') ?>
            <input type="hidden" name="action" value="pw_settings_save_action"/>

            <h3>Form Settings</h3>
            <div class="pwcf-field-wrap">
                <label>Name Field Label</label>
                <div class="pwcf-field">
                    <input type="text" name="name_field_label" value="<?php echo (!empty( $pwcf_settings['name'] )) ? $pwcf_settings['name'] : ''; ?>"/>
                </div>
            </div>
            <div class="pwcf-field-wrap">
                <label>Email Field Label</label>
                <div class="pwcf-field">
                    <input type="text" name="email_field_label" value="<?php echo (!empty( $pwcf_settings['email'] )) ? $pwcf_settings['email'] : ''; ?>"/>
                </div>
            </div>
            <div class="pwcf-field-wrap">
                <label>Message Field Label</label>
                <div class="pwcf-field">
                    <input type="text" name="message_field_label" value="<?php echo (!empty( $pwcf_settings['message'] )) ? $pwcf_settings['message'] : ''; ?>"/>
                </div>
            </div>
            <div class="pwcf-field-wrap">
                <label>Submit Button Label</label>
                <div class="pwcf-field">
                    <input type="text" name="submit_button_label" value="<?php echo (!empty( $pwcf_settings['submit_button_label'] )) ? $pwcf_settings['submit_button_label'] : ''; ?>"/>
                </div>
            </div>
            <h3>Other Settings</h3>
            <div class="pwcf-field-wrap">
                <label>Admin Email</label>
                <div class="pwcf-field">
                    <input type="text" name="admin_email" value="<?php echo (!empty( $pwcf_settings['admin_email'] )) ? $pwcf_settings['admin_email'] : ''; ?>"/>
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