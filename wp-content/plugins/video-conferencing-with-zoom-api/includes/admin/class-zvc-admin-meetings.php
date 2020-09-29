<?php

/**
 * Meetings Controller
 *
 * @since   2.1.0
 * @author  Deepen
 */
class Zoom_Video_Conferencing_Admin_Meetings {

	public static $message = '';
	public $settings;

	public function __construct() {
	}

	/**
	 * View list meetings page
	 *
	 * @since   1.0.0
	 * @changes in CodeBase
	 * @author  Deepen Bajracharya <dpen.connectify@gmail.com>
	 */
	public static function list_meetings() {
		wp_enqueue_script( 'video-conferencing-with-zoom-api-js' );
		wp_enqueue_script( 'video-conferencing-with-zoom-api-select2-js' );
		wp_enqueue_script( 'video-conferencing-with-zoom-api-datable-js' );

		//Get Template
		require_once ZVC_PLUGIN_VIEWS_PATH . '/tpl-list-meetings.php';
	}

	/**
	 * Add Meetings Page
	 *
	 * @since    1.0.0
	 * @modified 2.1.0
	 * @author   Deepen Bajracharya <dpen.connectify@gmail.com>
	 */
	public static function add_meeting() {
		wp_enqueue_script( 'video-conferencing-with-zoom-api-js' );
		wp_enqueue_script( 'video-conferencing-with-zoom-api-select2-js' );
		wp_enqueue_script( 'video-conferencing-with-zoom-api-timepicker-js' );

		//Edit a Meeting
		if ( isset( $_GET['edit'] ) && isset( $_GET['host_id'] ) ) {
			if ( isset( $_POST['update_meeting'] ) ) {
				self::update_meeting();
			}

			//Get Editin Template
			require_once ZVC_PLUGIN_VIEWS_PATH . '/tpl-edit-meeting.php';
		} else {
			if ( isset( $_POST['create_meeting'] ) ) {
				self::create_meeting();
			}

			//Get Template
			require_once ZVC_PLUGIN_VIEWS_PATH . '/tpl-add-meetings.php';
		}
	}

	/**
	 * Update Meeting
	 *
	 * @since  2.1.0
	 * @author Deepen
	 */
	private static function update_meeting() {
		check_admin_referer( '_zoom_update_meeting_nonce_action', '_zoom_update_meeting_nonce' );

		$update_meeting_arr = array(
			'meeting_id'                => filter_input( INPUT_POST, 'meeting_id' ),
			'topic'                     => filter_input( INPUT_POST, 'meetingTopic' ),
			'agenda'                    => filter_input( INPUT_POST, 'agenda' ),
			'start_date'                => filter_input( INPUT_POST, 'start_date' ),
			'timezone'                  => filter_input( INPUT_POST, 'timezone' ),
			'password'                  => filter_input( INPUT_POST, 'password' ),
			'duration'                  => filter_input( INPUT_POST, 'duration' ),
			'option_jbh'                => filter_input( INPUT_POST, 'join_before_host' ),
			'option_host_video'         => filter_input( INPUT_POST, 'option_host_video' ),
			'option_participants_video' => filter_input( INPUT_POST, 'option_participants_video' ),
			'option_mute_participants'  => filter_input( INPUT_POST, 'option_mute_participants' ),
			'option_enforce_login'      => filter_input( INPUT_POST, 'option_enforce_login' ),
			'option_auto_recording'     => filter_input( INPUT_POST, 'option_auto_recording' ),
			'alternative_host_ids'      => filter_input( INPUT_POST, 'alternative_host_ids', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY )
		);

		$meeting_updated = json_decode( zoom_conference()->updateMeetingInfo( $update_meeting_arr ) );
		if ( ! empty( $meeting_updated->error ) ) {
			self::set_message( 'error', $meeting_updated->error->message );
		} else {
			self::set_message( 'updated', __( "Updated meeting.", "video-conferencing-with-zoom-api" ) );
		}

		/**
		 * Fires after meeting has been Updated
		 *
		 * @since  2.0.1
		 */
		do_action( 'zvc_after_updated_meeting' );
	}

	/**
	 * Create a new Meeting
	 *
	 * @since  2.1.0
	 * @author Deepen
	 */
	private static function create_meeting() {
		check_admin_referer( '_zoom_add_meeting_nonce_action', '_zoom_add_meeting_nonce' );
		$create_meeting_arr = array(
			'userId'                    => filter_input( INPUT_POST, 'userId' ),
			'meetingTopic'              => filter_input( INPUT_POST, 'meetingTopic' ),
			'agenda'                    => filter_input( INPUT_POST, 'agenda' ),
			'start_date'                => filter_input( INPUT_POST, 'start_date' ),
			'timezone'                  => filter_input( INPUT_POST, 'timezone' ),
			'password'                  => filter_input( INPUT_POST, 'password' ),
			'duration'                  => filter_input( INPUT_POST, 'duration' ),
			'join_before_host'          => filter_input( INPUT_POST, 'join_before_host' ),
			'option_host_video'         => filter_input( INPUT_POST, 'option_host_video' ),
			'option_participants_video' => filter_input( INPUT_POST, 'option_participants_video' ),
			'option_mute_participants'  => filter_input( INPUT_POST, 'option_mute_participants' ),
			'option_enforce_login'      => filter_input( INPUT_POST, 'option_enforce_login' ),
			'option_auto_recording'     => filter_input( INPUT_POST, 'option_auto_recording' ),
			'alternative_host_ids'      => filter_input( INPUT_POST, 'alternative_host_ids', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY )
		);

		$meeting_created = json_decode( zoom_conference()->createAMeeting( $create_meeting_arr ) );
		if ( ! empty( $meeting_created->error ) ) {
			self::set_message( 'error', $meeting_created->error->message );
		} else if ( ! empty( $meeting_created->code ) && $meeting_created->code == 1113 ) {
			self::set_message( 'error', $meeting_created->message );
		} else {
			self::set_message( 'updated', sprintf( __( "Created meeting %s at %s. Join %s", "video-conferencing-with-zoom-api" ), $meeting_created->topic, $meeting_created->created_at, "<a target='_blank' href='" . $meeting_created->join_url . "'>Here</a>" ) );

			/**
			 * Fires after meeting has been Created
			 *
			 * @since  2.0.1
			 */
			do_action( 'zvc_after_created_meeting', $meeting_created );
		}
	}

	static function get_message() {
		return self::$message;
	}

	static function set_message( $class, $message ) {
		self::$message = '<div class=' . $class . '><p>' . $message . '</p></div>';
	}
}

new Zoom_Video_Conferencing_Admin_Meetings();