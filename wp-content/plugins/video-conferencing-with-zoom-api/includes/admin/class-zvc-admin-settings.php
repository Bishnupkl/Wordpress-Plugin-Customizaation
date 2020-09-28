<?php

/**
 * Registering the Pages Here
 *
 * @since   2.0.0
 * @author  Deepen
 */
class Zoom_Video_Conferencing_Admin_Views {

	public static $message = '';
	public $settings;

	public function __construct() {
		add_action( 'admin_menu', array( $this, 'zoom_video_conference_menus' ) );
	}

	/**
	 * Register Menus
	 *
	 * @since   1.0.0
	 * @updated 3.0.0
	 * @changes in CodeBase
	 * @author  Deepen Bajracharya <dpen.connectify@gmail.com>
	 */
	public function zoom_video_conference_menus() {
		if ( get_option( 'zoom_api_key' ) && get_option( 'zoom_api_secret' ) ) {
			add_submenu_page( 'edit.php?post_type=zoom-meetings', __( 'Live Meetings', 'video-conferencing-with-zoom-api' ), __( 'Live Meetings', 'video-conferencing-with-zoom-api' ), 'manage_options', 'zoom-video-conferencing', array( 'Zoom_Video_Conferencing_Admin_Meetings', 'list_meetings' ) );

			add_submenu_page( 'edit.php?post_type=zoom-meetings', __( 'Add Live Meeting', 'video-conferencing-with-zoom-api' ), __( 'Add Live Meeting', 'video-conferencing-with-zoom-api' ), 'manage_options', 'zoom-video-conferencing-add-meeting', array( 'Zoom_Video_Conferencing_Admin_Meetings', 'add_meeting' ) );

			add_submenu_page( 'edit.php?post_type=zoom-meetings', __( 'Zoom Users', 'video-conferencing-with-zoom-api' ), __( 'Zoom Users', 'video-conferencing-with-zoom-api' ), 'manage_options', 'zoom-video-conferencing-list-users', array( 'Zoom_Video_Conferencing_Admin_Users', 'list_users' ) );

			add_submenu_page( 'edit.php?post_type=zoom-meetings', __( 'Reports', 'video-conferencing-with-zoom-api' ), __( 'Reports', 'video-conferencing-with-zoom-api' ), 'manage_options', 'zoom-video-conferencing-reports', array( 'Zoom_Video_Conferencing_Reports', 'zoom_reports' ) );

			add_submenu_page( 'edit.php?post_type=zoom-meetings', __( 'Addons', 'video-conferencing-with-zoom-api' ), __( 'Addons', 'video-conferencing-with-zoom-api' ), 'manage_options', 'zoom-video-conferencing-addons', array( 'Zoom_Video_Conferencing_Admin_Addons', 'render' ) );

			//Only for developers. So this is hidden !
			if ( defined( 'VIDEO_CONFERENCING_HOST_ASSIGN_PAGE' ) ) {
				add_submenu_page( 'edit.php?post_type=zoom-meetings', __( 'Assign Host ID', 'video-conferencing-with-zoom-api' ), __( 'Assign Host ID', 'video-conferencing-with-zoom-api' ), 'manage_options', 'zoom-video-conferencing-host-id-assign', array( 'Zoom_Video_Conferencing_Admin_Users', 'assign_host_id' ) );
			}
		}

		add_submenu_page( 'edit.php?post_type=zoom-meetings', __( 'Settings', 'video-conferencing-with-zoom-api' ), __( 'Settings', 'video-conferencing-with-zoom-api' ), 'manage_options', 'zoom-video-conferencing-settings', array( $this, 'zoom_video_conference_api_zoom_settings' ) );
	}


	/**
	 * Zoom Settings View File
	 *
	 * @since   1.0.0
	 * @changes in CodeBase
	 * @author  Deepen Bajracharya <dpen.connectify@gmail.com>
	 */
	public function zoom_video_conference_api_zoom_settings() {
		wp_enqueue_script( 'video-conferencing-with-zoom-api-js' );
		wp_enqueue_style( 'video-conferencing-with-zoom-api' );

		if ( get_option( 'zoom_api_key' ) && get_option( 'zoom_api_secret' ) ) {
			$encoded_users = zoom_conference()->listUsers();
			if ( ! empty( json_decode( $encoded_users )->error ) ) {
				?>
                <div id="message" class="notice notice-error">
                    <p><?php echo json_decode( $encoded_users )->error->message; ?></p>
                </div>
				<?php
			}
		}

		if ( isset( $_POST['save_zoom_settings'] ) ) {
			//Nonce
			check_admin_referer( '_zoom_settings_update_nonce_action', '_zoom_settings_nonce' );
			$zoom_api_key    = sanitize_text_field( filter_input( INPUT_POST, 'zoom_api_key' ) );
			$zoom_api_secret = sanitize_text_field( filter_input( INPUT_POST, 'zoom_api_secret' ) );
			$vanity_url      = esc_url_raw( filter_input( INPUT_POST, 'vanity_url' ) );
			$join_links      = filter_input( INPUT_POST, 'meeting_end_join_link' );

			update_option( 'zoom_api_key', $zoom_api_key );
			update_option( 'zoom_api_secret', $zoom_api_secret );
			update_option( 'zoom_vanity_url', $vanity_url );
			update_option( 'zoom_past_join_links', $join_links );

			//After user has been created delete this transient in order to fetch latest Data.
			delete_transient( '_zvc_user_lists' );
			?>
            <div id="message" class="notice notice-success is-dismissible">
                <p><?php _e( 'Successfully Updated. Please refresh this page.', 'video-conferencing-with-zoom-api' ); ?></p>
                <button type="button" class="notice-dismiss"><span class="screen-reader-text"><?php _e( 'Dismiss this notice.', 'video-conferencing-with-zoom-api' ); ?></span></button>
            </div>
			<?php
		}

		//Get Template
		require_once ZVC_PLUGIN_VIEWS_PATH . '/tpl-settings.php';
	}

	static function get_message() {
		return self::$message;
	}

	static function set_message( $class, $message ) {
		self::$message = '<div class=' . $class . '><p>' . $message . '</p></div>';
	}
}

new Zoom_Video_Conferencing_Admin_Views();
