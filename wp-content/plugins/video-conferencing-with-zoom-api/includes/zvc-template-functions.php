<?php
/**
 * @author Deepen.
 * @created_on 11/20/19
 */

/**
 * Function to check if a user is logged in or not
 * @author Deepen
 * @since 3.0.0
 */
function video_conference_zoom_check_login() {
	global $zoom;
	if ( ! empty( $zoom ) && ! empty( $zoom['site_option_logged_in'] ) ) {
		if ( is_user_logged_in() ) {
			return "loggedin";
		} else {
			return false;
		}
	} else {
		return "no_check";
	}
}

/**
 * Function to view featured image on the post
 * @author Deepen
 * @since 3.0.0
 */
function video_conference_zoom_featured_image() {
	vczapi_get_template( array( 'fragments/image.php' ), true );
}

/**
 * Function to view main content i.e title and main content
 * @author Deepen
 * @since 3.0.0
 */
function video_conference_zoom_main_content() {
	vczapi_get_template( array( 'fragments/content.php' ), true );
}

/**
 * Function to add in the counter
 * @author Deepen
 * @since 3.0.0
 */
function video_conference_zoom_countdown_timer() {
	vczapi_get_template( array( 'fragments/countdown-timer.php' ), true );
}

/**
 * Function to show meeting details
 * @author Deepen
 * @since 3.0.0
 */
function video_conference_zoom_meeting_details() {
	vczapi_get_template( array( 'fragments/meeting-details.php' ), true );
}

/**
 * Function to show meeting join links
 *
 * @author Deepen
 * @since 3.0.0
 */
function video_conference_zoom_meeting_join() {
	$data = array(
		'ajaxurl'    => admin_url( 'admin-ajax.php' ),
		'start_date' => $zoom['start_date'],
		'timezone'   => $zoom['timezone'],
		'post_id'    => get_the_ID(),
		'page'       => 'single-meeting'
	);
	wp_localize_script( 'video-conferencing-with-zoom-api', 'mtg_data', $data );
}

/**
 * Generate join links
 *
 * @param $zoom_meeting
 *
 * @since 3.0.0
 *
 * @author Deepen
 */
function video_conference_zoom_meeting_join_link( $zoom_meeting ) {
	global $vanity_enabled;

	if ( empty( $vanity_enabled ) ) {
		$browser_url = 'https://zoom.us/wc/join/';
	} else {
		$browser_url = trailingslashit( $vanity_enabled . '/wc/join/' );
	}

	if ( ! empty( $zoom_meeting->join_url ) ) {
		?>
        <a href="<?php echo esc_url( $zoom_meeting->join_url ); ?>" class="btn btn-join-link"><?php echo apply_filters( 'vczoom_join_meeting_via_app_text', __( 'Join Meeting via Zoom App', 'video-conferencing-with-zoom-api' ) ); ?></a>
		<?php
	}

	if ( ! empty( $zoom_meeting->id ) ) {
		?>
        <a href="<?php echo esc_url( $browser_url . $zoom_meeting->id ); ?>" class="btn btn-join-link"><?php echo apply_filters( 'vczoom_join_meeting_via_app_text', __( 'Join via Web Browser', 'video-conferencing-with-zoom-api' ) ); ?></a>
		<?php
	}
}

/**
 * Generate join links
 *
 * @param $zoom_meetings
 *
 * @since 3.0.0
 *
 * @author Deepen
 */
function video_conference_zoom_shortcode_join_link( $zoom_meetings ) {
	global $vanity_uri;

	/**
	 * @TO-DO
	 * 1. Sometimes zoom does not produce https://zoom.us/j uri by default
	 */
	if ( ! empty( $vanity_uri ) ) {
		$browser_url = trailingslashit( $vanity_uri . 'wc/join/' . $zoom_meetings->id );
		$join_uri    = trailingslashit( $vanity_uri . '/j/' . $zoom_meetings->id );
	} else {
		$browser_url = 'https://zoom.us/wc/join/' . $zoom_meetings->id;
		$join_uri    = 'https://zoom.us/j/' . $zoom_meetings->id;
	}

	$data = array(
		'ajaxurl'     => admin_url( 'admin-ajax.php' ),
		'start_date'  => $zoom_meetings->start_time,
		'timezone'    => $zoom_meetings->timezone,
		'type'        => 'shortcode',
		'join_uri'    => $join_uri,
		'browser_url' => $browser_url
	);
	wp_localize_script( 'video-conferencing-with-zoom-api', 'mtg_data', $data );
}

/**
 * Render Zoom Meeting ShortCode table in frontend
 *
 * @param $zoom_meetings
 *
 * @author Deepen
 *
 * @since 3.0.0
 */
function video_conference_zoom_shortcode_table( $zoom_meetings ) {
	?>
    <table>
        <tr>
            <td><?php _e( 'Meeting ID', 'video-conferencing-with-zoom-api' ); ?></td>
            <td><?php echo $zoom_meetings->id; ?></td>
        </tr>
        <tr>
            <td><?php _e( 'Topic', 'video-conferencing-with-zoom-api' ); ?></td>
            <td><?php echo $zoom_meetings->topic; ?></td>
        </tr>
        <tr>
            <td><?php _e( 'Meeting Status', 'video-conferencing-with-zoom-api' ); ?></td>
            <td>
				<?php echo $zoom_meetings->status; ?>
                <p class="small-description"><?php _e( 'Refresh is needed to change status.', 'video-conferencing-with-zoom-api' ); ?></p>
            </td>
        </tr>
        <tr>
            <td><?php _e( 'Start Time', 'video-conferencing-with-zoom-api' ); ?></td>
            <td><?php echo vczapi_dateConverter( $zoom_meetings->start_time, $zoom_meetings->timezone, 'F j, Y @ g:i a' );; ?></td>
        </tr>
        <tr>
            <td><?php _e( 'Timezone', 'video-conferencing-with-zoom-api' ); ?></td>
            <td><?php echo $zoom_meetings->timezone; ?></td>
        </tr>
        <tr class="zvc-table-shortcode-duration">
            <td><?php _e( 'Duration', 'video-conferencing-with-zoom-api' ); ?></td>
            <td><?php echo $zoom_meetings->duration; ?></td>
        </tr>
		<?php
		/**
		 * Hook: vczoom_meeting_shortcode_join_links
		 *
		 * @video_conference_zoom_shortcode_join_link - 10
		 *
		 */
		do_action( 'vczoom_meeting_shortcode_join_links', $zoom_meetings );
		?>
    </table>
	<?php
}

if ( ! function_exists( 'video_conference_zoom_output_content_start' ) ) {
	function video_conference_zoom_output_content_start() {
		vczapi_get_template( array( 'global/wrap-start.php' ), true );
	}
}

if ( ! function_exists( 'video_conference_zoom_output_content_end' ) ) {
	function video_conference_zoom_output_content_end() {
		vczapi_get_template( array( 'global/wrap-end.php' ), true );
	}
}

/**
 * Get a slug identifying the current theme.
 *
 * @return string
 * @since 3.0.2
 */
function video_conference_zoom_get_current_theme_slug() {
	return apply_filters( 'video_conference_zoom_theme_slug_for_templates', get_option( 'template' ) );
}