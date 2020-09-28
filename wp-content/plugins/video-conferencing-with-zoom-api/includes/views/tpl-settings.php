<?php
//Defining Varaibles
$zoom_api_key    = get_option( 'zoom_api_key' );
$zoom_api_secret = get_option( 'zoom_api_secret' );
$zoom_vanity_url = get_option( 'zoom_vanity_url' );
$past_join_links = get_option( 'zoom_past_join_links' );
?>
<div id="zvc-cover" style="display: none;"></div>
<div class="wrap">
    <h1><?php _e( 'Settings', 'video-conferencing-with-zoom-api' ); ?></h1>

	<?php video_conferencing_zoom_api_show_like_popup(); ?>

    <div class="zvc-row">
        <div class="zvc-position-floater-left">
            <h3><?php _e( 'Please follow', 'video-conferencing-with-zoom-api' ) ?> <a target="_blank" href="<?php echo ZVC_PLUGIN_AUTHOR; ?>/zoom-conference-wp-plugin-documentation/"><?php _e( 'this guide', 'video-conferencing-with-zoom-api' ) ?> </a> <?php _e( 'to generate the below API values from your Zoom account', 'video-conferencing-with-zoom-api' ) ?></h3>

            <form action="edit.php?post_type=zoom-meetings&page=zoom-video-conferencing-settings" method="POST">
				<?php wp_nonce_field( '_zoom_settings_update_nonce_action', '_zoom_settings_nonce' ); ?>
                <table class="form-table">
                    <tbody>
                    <tr>
                        <th><label><?php _e( 'API Key', 'video-conferencing-with-zoom-api' ); ?></label></th>
                        <td><input type="password" style="width: 400px;" name="zoom_api_key" id="zoom_api_key" value="<?php echo ! empty( $zoom_api_key ) ? esc_html( $zoom_api_key ) : ''; ?>"> <a href="javascript:void(0);" class="toggle-api">Show</a></td>
                    </tr>
                    <tr>
                        <th><label><?php _e( 'API Secret Key', 'video-conferencing-with-zoom-api' ); ?></label></th>
                        <td><input type="password" style="width: 400px;" name="zoom_api_secret" id="zoom_api_secret" value="<?php echo ! empty( $zoom_api_secret ) ? esc_html( $zoom_api_secret ) : ''; ?>"> <a href="javascript:void(0);" class="toggle-secret">Show</a></td>
                    </tr>
                    <tr class="enabled-vanity-url">
                        <th><label><?php _e( 'Vanity URL', 'video-conferencing-with-zoom-api' ); ?></label></th>
                        <td>
                            <input type="url" name="vanity_url" class="regular-text" value="<?php echo ( $zoom_vanity_url ) ? esc_html( $zoom_vanity_url ) : ''; ?>" placeholder="https://example.zoom.us">
                            <p class="description"><?php _e( 'This URI will be replaced with default zoom link.', 'video-conferencing-with-zoom-api' ); ?></p>
                        </td>
                    </tr>
                    <tr class="enabled-join-links-after-mtg-end">
                        <th><label><?php _e( 'Show Past Join Link ?', 'video-conferencing-with-zoom-api' ); ?></label></th>
                        <td>
                            <input type="checkbox" name="meeting_end_join_link" <?php checked( $past_join_links, 'on' ); ?>>
                            <p class="description"><?php _e( 'This will show join meeting links on frontend even after meeting time is already past.', 'video-conferencing-with-zoom-api' ); ?></p>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <p class="description"><?php _e( 'After you enter your keys. Do save changes before doing "Check API Connection".', 'video-conferencing-with-zoom-api' ); ?></p>
                <p class="submit"><input type="submit" name="save_zoom_settings" id="submit" class="button button-primary" value="<?php esc_html_e( 'Save Changes', 'video-conferencing-with-zoom-api' ); ?>"> <a href="javascript:void(0);" class="button button-primary check-api-connection"><?php esc_html_e( 'Check API Connection', 'video-conferencing-with-zoom-api' ); ?></a></p>
            </form>

            <hr>
            <section class="zoom-api-example-section">
                <h3>Using Shortcode Example</h3>
                <p>Below are few examples of how you can add shortcodes manually into your posts.</p>

                <div class="zoom-api-basic-usage">
                    <h3>Basic Usage:</h3>
                    <code>[zoom_api_link meeting_id="123456789" link_only="no"]</code>
                    <div class="zoom-api-basic-usage-description">
                        <label>Parameters:</label>
                        <ul>
                            <li><strong>meeting_id</strong> : Your meeting ID.</li>
                            <li><strong>link_only</strong> : Yes or No - Adding yes will show join link only. Removing this parameter from shortcode will output description.</li>
                        </ul>
                    </div>
                </div>
            </section>
        </div>

        <div class="zvc-position-floater-right">
            <ul class="zvc-information-sec">
                <li><a target="_blank" href="<?php echo ZVC_PLUGIN_AUTHOR; ?>/zoom-conference-wp-plugin-documentation/"><?php _e( 'Documentation', 'video-conferencing-with-zoom-api' ); ?></a></li>
                <li><a target="_blank" href="<?php echo ZVC_PLUGIN_AUTHOR; ?>/say-hello/"><?php _e( 'Contact for additional Support', 'video-conferencing-with-zoom-api' ); ?></a></li>
                <li><a target="_blank" href="https://deepenbajracharya.com.np"><?php _e( 'Developer', 'video-conferencing-with-zoom-api' ); ?></a></li>
                <li><a target="_blank" href="<?php echo admin_url('edit.php?post_type=zoom-meetings&page=zoom-video-conferencing-addons'); ?>"><?php _e( 'Addons', 'video-conferencing-with-zoom-api' ); ?></a></li>
            </ul>
            <div class="zvc-information-sec">
                <h3>WooCommerce Addon</h3>
                <p>Integrate your Zoom Meetings directly to WooCommerce booking products. Zoom Integration for WooCommerce Booking allows you
                    to automate your zoom meetings directly from your WordPress dashboard by linking zoom meetings to your WooCommerce Booking
                    products automatically when a Booking Product is created. Users will receive join links in their booking confirmation
                    emails.</p>
                <p><a href="https://www.codemanas.com/downloads/zoom-integration-for-woocommerce-booking/" class="button button-primary">From:
                        $30</a></p>
            </div>
            <div class="zvc-information-sec">
                <h3>Need Idle Auto logout ?</h3>
                <p>Protect your WordPress users' sessions from shoulder surfers and snoopers!</p>
                <p>Use the Inactive Logout plugin to automatically terminate idle user sessions, thus protecting the site if the users leave unattended sessions.</p>
                <p><a target="_blank" href="https://wordpress.org/plugins/inactive-logout/"><?php _e( 'Try inactive logout', 'video-conferencing-with-zoom-api' ); ?></a>
            </div>
        </div>
    </div>
    <div class="zvc-position-clear"></div>
</div>
