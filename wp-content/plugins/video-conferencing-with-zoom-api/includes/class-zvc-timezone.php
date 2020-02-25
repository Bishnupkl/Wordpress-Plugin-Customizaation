<?php
/**
 * Timezones AJAX handler
 *
 * @since   3.1.2
 * @author  Deepen
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Zoom_Video_Conferencing_Timezone {

	public function __construct() {
		add_action( 'wp_ajax_set_timezone', array( $this, 'set_timezone' ) );
		add_action( 'wp_ajax_nopriv_set_timezone', array( $this, 'set_timezone' ) );
	}

	/**
	 * See timezone and show links accordingly
	 *
	 * @throws Exception
	 * @author Deepen Bajracharya
	 * @since 3.1.2
	 */
	public function set_timezone() {
		$user_timezone = filter_input( INPUT_POST, 'user_timezone' );
		$mtg_timezone  = filter_input( INPUT_POST, 'mtg_timezone' );
		$start_date    = filter_input( INPUT_POST, 'start_date' );
		$type          = filter_input( INPUT_POST, 'type' );

		$meeting_timezone_time = new DateTime( $start_date, new DateTimeZone( $mtg_timezone ) );
		$meeting_timezone_time->setTimezone( new DateTimeZone( $user_timezone ) );
		$user_meeting_time = strtotime( $meeting_timezone_time->format( 'Y-m-d H:i:s' ) );

		$current_user_time = new DateTime( 'now', new DateTimeZone( $user_timezone ) );
		$current_user_time = strtotime( $current_user_time->format( 'Y-m-d H:i:s' ) ) - 60 * 60; //1 hour

		if ( $current_user_time <= $user_meeting_time ) {
			if ( $type === "page" ) {
				$post_id = filter_input( INPUT_POST, 'post_id' );
				wp_send_json_success( $this->output_join_links_page( $post_id ) );
			} else {
				$join_uri    = filter_input( INPUT_POST, 'join_uri' );
				$browser_url = filter_input( INPUT_POST, 'browser_url' );
				wp_send_json_success( $this->output_join_links_shortcodes( $join_uri, $browser_url ) );
			}
		} else {
			wp_send_json_error( apply_filters( 'vczoom_shortcode_link_not_valid_anymore', __( 'This meeting is no longer valid and cannot be joined !', 'video-conferencing-with-zoom-api' ) ) );
		}

		wp_die();
	}

	/**
	 * Show join links from here for pages
	 *
	 * @param $post_id
	 *
	 * @return false|string
	 * @author Deepen Bajracharya
	 *
	 */
	private function output_join_links_page( $post_id ) {
		$GLOBALS['zoom_meeting']   = get_post_meta( $post_id, '_meeting_zoom_details', true );
		$GLOBALS['vanity_enabled'] = get_option( 'zoom_vanity_url' );

		ob_start(); //Init the output buffering
		$template = vczapi_get_template( array( 'fragments/join-links.php' ), false );
		include $template;
		$content = ob_get_clean(); //Get the buffer and erase it

		return $content;
	}

	private function output_join_links_shortcodes( $join_uri, $browser_url ) {
		ob_start(); //Init the output buffering
		$template = vczapi_get_template( array( 'shortcode/join-links.php' ), false );
		include $template;
		$content = ob_get_clean(); //Get the buffer and erase it

		return $content;
	}

}

new Zoom_Video_Conferencing_Timezone();